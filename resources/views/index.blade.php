@extends('layouts.master')

@section('header')
    @include('header')
@endsection

@section('index')
    <div id="cover">
        <h1 id="cover_title">BOOK SHELF</h1>
        <form action="index.php" method="post">
            <div class="book_status unread active">
                <input type="submit" name="submit_only_unread" value="Unread">
                <div class="book_count"><?php echo($booksUnreadCount); ?></div>
            </div>
            <div class="book_status reading active">
                <input type="submit" name="submit_only_reading" value="Reading"><br>
                <div class="book_count"><?php echo($booksReadingCount); ?></div>
            </div>
            <div class="book_status finished active">
                <input type="submit" name="submit_only_finished" value="Finished"><br>
                <div class="book_count"><?php echo($booksFinishedCount); ?></div>
            </div>
        </form>
    </div>

    <div class="wrapper">
        <div id="main">
            <div id="book_list" class="clearfix">
                @foreach ($books as $book)
                    <div class="book_item">

                        <div class="book_image">
                            <img src="/{{ $book->image }}" alt="{{$book->image}}">
                        </div>

                        <div class="book_detail">
                            <div class="book_title">
                                {{$book->name}}
                            </div>
                            <form action="/update/{{$book->id}}" method="POST">
                                    @csrf
                                    <div class="book_status unread <?php if ($book->status == "unread") print "active"; ?>">
                                        <input type="submit" name="unread" value="Unread">
                                    </div>
                                    <div class="book_status reading <?php if ($book->status == "reading") print "active"; ?>">
                                        <input type="submit" name="reading" value="Reading">
                                    </div>
                                    <div class="book_status finished <?php if ($book->status == "finished") print "active"; ?>">
                                        <input type="submit" name="finished" value="Finished">
                                    </div>
                            </form>
                            <form action="/delete/{{$book->id}}" method="POST">
                                    <div class="book_delete">
                                        @csrf
                                        <input type="submit" value="Delete"><img src="img/icon_trash.png" alt="icon trash">
                                    </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
