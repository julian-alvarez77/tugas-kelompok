@extends('layouts.master')

@section('header')
    @include('header')
@endsection

@section('index')
    <div id="cover">
        <h1 id="cover_title">BOOK SHELF</h1>
        <div class="container mx-auto">
            <div class="row justify-content-center">
                <div class="col-sm-4 text-center">
                    <button class="btn btn-primary" style="width: 150px; height: 60px;">
                        Tersedia <br> {{$booksAvailableCount}}
                    </button>
                </div>
                <div class="col-sm-4 text-center">
                    <button class="btn btn-danger" style="width: 150px; height: 60px;">
                        Tidak Tersedia <br> {{$booksUnvailableCount}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div id="main">
            <div id="book_list" class="clearfix">
                @if (count($books) == 0)
                    <div>
                        Belum ada buku 
                    </div>
                @endif
                @foreach ($books as $book)
                    <div class="book_item">

                        <div class="book_image">
                            <img src="/{{ $book->image }}" alt="{{$book->image}}">
                        </div>

                        <div class="book_detail">
                            <div class="book_title">
                                {{$book->name}}
                            </div>
                            <div class="book_author">
                               Penulis : {{$book->author}}
                            </div>
                            <div class="book_year">
                               Tahun : {{$book->year}}
                            </div>
                            <div class="book_status">
                               Status : {{$book->is_borrowed ? "Dipinjam" : "Tersedia"}}
                            </div>
                            @if ($book->is_borrowed != true)                                
                            <form action="/update/{{$book->id}}" method="POST">
                                    @csrf
                                    <div class="btn btn-info">
                                        <input name="borrow" value="true" hidden>
                                        <input type="submit" value="Pinjam">
                                    </div>
                            </form>
                            @endif
                            @if (auth()->check() && auth()->user()->is_admin)
                            <form action="/delete/{{$book->id}}" method="POST">
                                <div class="book_delete">
                                    @csrf
                                    <input type="submit" value="Delete"><img src="img/icon_trash.png" alt="icon trash">
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
