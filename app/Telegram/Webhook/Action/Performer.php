<?php

namespace App\Telegram\Webhook\Action;

use App\Facades\Telegram;
use App\Models\Category;
use App\Models\User;
use App\Telegram\Helpers\InlineButton;
use App\Telegram\Webhook\Webhook;

class Performer extends Webhook
{
    public function run()
    {
        $user = $this->getUser();

        switch ($user->state) {
            case 'waiting_for_name':
                $this->saveName($user);
                break;
            case 'waiting_for_phone':
                $this->savePhoneNumber($user);
                break;
            case 'waiting_for_category':
                $this->handleCategorySelection($user);
                break;
            case 'waiting_for_child_category':
                $this->saveCategory($user);
                break;
            case 'waiting_for_min_cost':
                $this->saveMinCost($user);
                break;
            case 'waiting_for_description':
                $this->saveServiceDescription($user);
                break;
            default:
                $this->startRegistration($user);
                break;
        }
    }

    private function getUser()
    {
        $tgId = $this->request->input('message')['from']['id'] ?? $this->request->input('callback_query')['from']['id'];
        $user = User::where('tg_id', $tgId)->first();

        if (!$user) {
            $user = new User();
            $user->tg_id = $tgId;
            $user->save();
        }

        return $user;
    }

    private function startRegistration(User $user)
    {
        $user->state = 'waiting_for_name';
        $user->save();

        Telegram::message($user->tg_id, 'Ваше полное имя и фамилия:')->send();
    }

    private function saveName(User $user)
    {
        $user->name = $this->request->input('message')['text'];
        $user->state = 'waiting_for_phone';
        $user->save();

        Telegram::message($user->tg_id, 'Ваш номер телефона: ')->send();
    }

    private function savePhoneNumber(User $user)
    {
        $user->phone_number = $this->request->input('message')['text'];
        $user->state = 'waiting_for_category';
        $user->save();

        $this->sendCategories($user);
    }

    private function sendCategories(User $user)
    {
        $categories = Category::whereNull('parent_id')->get();

        foreach ($categories as $category) {
            InlineButton::add($category->name, 'Performer', ['data' => $category->id]);
        }

        Telegram::inlineButton($user->tg_id, 'Выберите категорию услуг', InlineButton::$buttons)->send();
    }

    private function handleCategorySelection(User $user)
    {

        $category = json_decode($this->request->input('callback_query')['data']);
        $childCategories = Category::where('parent_id', $category->data)->get();


        foreach ($childCategories as $category) {
            InlineButton::add($category->name, 'Performer', ['data' => $category->id]);
        }

        Telegram::inlineButton($user->tg_id, 'Выберите подкатегорию', InlineButton::$buttons)->send();

        $user->state = 'waiting_for_child_category';
        $user->save();

    }

    private function saveCategory(User $user)
    {

        $category = json_decode($this->request->input('callback_query')['data']);

        $category = Category::find($category->data);


        $user->category_id = $category->id;
        $user->state = 'waiting_for_min_cost';
        $user->save();

        Telegram::message($user->tg_id, 'Введите минимальную стоимость ваших услуг: ')->send();
    }

    private function saveMinCost(User $user)
    {
        $minCost = $this->request->input('message')['text'];

        if (!is_numeric($minCost) || $minCost <= 0) {
            Telegram::message($user->tg_id, 'Введите правильную сумму')->send();
            return;
        }

        $user->min_service_cost = $minCost;
        $user->state = 'waiting_for_description';
        $user->save();

        Telegram::message($user->tg_id, 'Опишите ваши усулуги')->send();
    }

    private function saveServiceDescription(User $user)
    {
        $description = $this->request->input('message')['text'];
        $user->service_description = $description;
        $user->state = null;
        $user->save();

        Telegram::message($user->tg_id, 'Регистрация завершена! Спасибо')->send();
    }
}
