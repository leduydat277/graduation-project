@extends('client.layouts.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('title')
Đánh giá & Bình luận
@endsection

@section('content')
@include('client.layouts.banner.banner')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div id="okoko" class="container">
    <h2>Đánh Giá Phòng Khách Sạn</h2>

    <div class="room-info">
        <img src="{{ asset('storage/' . $booking->room->thumbnail_image) }}" width="500px" height="400px" alt="Hinh Anh Phong">
        <h3>{{$booking->room->title}}</h3>
        <p>Đơn hàng: {{$booking->booking_number_id}}</p>
        <p>Giá: {{ number_format($booking->room->price, 0, ',', '.') }} VNĐ / Đêm</p>
    </div>

    <form action="{{ route('client.room-postComment', ['id' => $booking->room->id]) }}" method="POST">
        @csrf
        <div class="stars">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">&#9733;</label>
        </div>
        @error('rating')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <textarea name="comment" placeholder="Nhập bình luận của bạn...."></textarea>
        @error('comment')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit">Gửi đánh giá</button>
    </form>

    <div class="comments">
        <h3>Đánh giá: </h3>

        <div class="comments-list">
            @foreach($comments as $index => $comment)
            <div class="comment {{ $index >= 3 ? 'hidden' : '' }}">
                <div class="author">{{$comment->user->name}}</div>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=$comment->rating)
                        ★
                        @else
                        ☆
                        @endif
                        @endfor
                </div>
                <p>{{$comment->comment}}</p>
            </div>
            @endforeach
        </div>

        <div class="toggle-btn">
            <button id="toggleButton" onclick="toggleComments()">Xem Thêm</button>
        </div>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    #okoko {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .room-info {
        text-align: center;
        margin-bottom: 20px;
    }

    .room-info img {
        max-width: 100%;
        border-radius: 8px;
    }

    .room-info h3 {
        margin: 10px 0;
        font-size: 24px;
    }

    .room-info p {
        margin: 5px 0;
        color: #555;
    }

    .stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }

    .stars input {
        display: none;
    }

    .stars label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .stars input:checked~label,
    .stars input:hover~label,
    .stars label:hover~label {
        color: #f5b301;
    }

    textarea {
        width: 100%;
        height: 100px;
        margin: 15px 0;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        resize: none;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .comments {
        margin-top: 30px;
    }

    .comments h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .comment {
        margin-bottom: 15px;
        padding: 10px;
        background: #f1f1f1;
        border-radius: 5px;
    }

    .comment .author {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .comment .rating {
        color: #f5b301;
    }

    .hidden {
        display: none;
    }

    .toggle-btn {
        text-align: center;
        margin-top: 10px;
    }

    .toggle-btn button {
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .toggle-btn button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    function toggleComments() {
        const comments = document.querySelectorAll('.comments .comment');
        const hiddenComments = document.querySelectorAll('.comments .comment.hidden');
        const toggleButton = document.getElementById('toggleButton');

        if (hiddenComments.length > 0) {
            // Hiện tất cả các bình luận ẩn
            hiddenComments.forEach(function(comment) {
                comment.classList.remove('hidden');
            });
            toggleButton.textContent = "Ẩn Bớt";
        } else {
            // Ẩn bớt các bình luận sau 3 cái đầu tiên
            comments.forEach(function(comment, index) {
                if (index >= 3) {
                    comment.classList.add('hidden');
                }
            });
            toggleButton.textContent = "Xem Thêm";
        }
    }
</script>
@endsection