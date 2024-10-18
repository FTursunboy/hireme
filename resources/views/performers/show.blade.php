@extends('layouts.app')

<style>
    /* Common styles */
    .profile-card {
        margin-top: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .profile-image {
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-name {
        color: #0066cc;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-location {
        color: #666666;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    .action-buttons a
    {
        text-decoration: none;
        font-weight: bold;
        text-align: center;
    }

    .action-button {
        background-color: #f0f0f0;
        border: none;
        border-radius: 8px;
        color: #333333;
        cursor: pointer;
        font-size: 14px;
        padding: 8px 15px;
        flex-grow: 1;
    }

    .services-title {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .services-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }
    .services-list li {
        color: #666;
        font-size: 16px;
        margin-bottom: 1px;
        position: relative;
        padding-left: 15px;
    }
    .services-list li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: #999;
    }

    .min-cost {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .description {
        color: #333333;
        font-size: 16px;
        line-height: 1.5;
    }

    /* Mobile styles */
    @media (max-width: 767px) {
        .profile-card {
            padding: 0;
            box-shadow: none;
        }

        .profile-image-container {
            padding-top: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border: 3px solid #ffffff;
        }

        .profile-details {
            padding: 10px;
        }

        .profile-name, .profile-location {
            text-align: center;
        }

        .action-buttons {
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .services-title, .description-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
    }

    /* Desktop styles */
    @media (min-width: 768px) {
        .profile-card {
            display: flex;
            text-align: left;
        }

        .profile-image-container {
            flex-shrink: 0;
            margin-right: 20px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
        }

        .profile-details {
            flex-grow: 1;
        }
    }
</style>

@section('content')
    <div class="container">
        <div class="profile-card">
            <div class="profile-image-container">
                <img src="{{asset('burger.jpg')}}" alt="{{$profile->name}}"  class="profile-image">
            </div>
            <div class="profile-details">
                <h2 class="profile-name">{{$profile->name}} (муж, 28 лет)</h2>
                <p class="profile-location">{{$profile->address}}</p>
                <div class="action-buttons">
                    <a class="action-button">Telegram</a>
                    <a class="action-button">Позвонить</a>
                </div>
                <div class="services-container">
                    <div class="services-title">Услуги:</div>
                    <ul class="services-list">
                        @foreach($profile->categories as $category)
                        <li>{{$category->name}}</li>
                        @endforeach

                    </ul>
                </div>
                <p style="margin-top: 10px" >Минимальная стоимость услуг: <span class="min-cost">от 500 000 сум</span> </p>
                <div class="description-title">Описание</div>
                <p class="description">
                    {{$profile->service_description}}
                </p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Add any necessary JavaScript here -->
@endsection
