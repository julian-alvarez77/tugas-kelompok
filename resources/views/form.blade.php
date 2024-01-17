@extends('layouts.master')

@section('header')
    @include('header')
@endsection

@section('form')
<div class="container ">
		<div class="row justify-content-center">
    		<div class="col-md-8">
        		<div class="card">
            		<div class="card-header">{{ __('Tambah Buku') }}</div>

		                <div class="card-body">
				                <form action="{{ url('/')}}" method="POST" class="form_book" enctype="multipart/form-data">
				                @csrf
														<div class="form-group row">

														   <label for="book_title" class="col-md-4 col-form-label text-md-right ">{{ __('Nama') }}</label>
														   <div class="col-md-6">
														       <input type="text" name="book_title" class="form-control book-title" placeholder="The Lord Of The Rings" required>
														   </div>

														   <label for="book_author" class="col-md-4 col-form-label text-md-right ">{{ __('Penulis') }}</label>
														   <div class="col-md-6">
														       <input type="text" name="book_author" max class="form-control book-author" placeholder="Tolkien" required>
														   </div>


														   <label for="book_tahun" class="col-md-4 col-form-label text-md-right ">{{ __('Tahun') }}</label>
														   <div class="col-md-6">
														   <input type="number" name="book_tahun" class="form-control book-tahun" placeholder="1800" maxlength="4" required>														   </div>
															 <label for="book_title" class="col-md-4 col-form-label text-md-right ">{{ __('Foto') }}</label>
																	 <div class="col-md-6">
																		  <input type="file" name="book_image" class='form-control book-image' required>
																	 </div>
															 </label>

														</div>
														<div class="form-group row mb-0">
																 <div class="col-md-6 offset-md-4">
																		 <button type="submit" class="btn btn-success btn-block">
																				 {{ __('Submit') }}
																		 </button>
																 </div>
														</div>
				                </form>
		            		</div>
            </div>
	      </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const bookTahunInput = document.querySelector('.book-tahun');

		bookTahunInput.addEventListener('input', (event) => {
    if (event.target.value.length > 4) {
        event.target.value = event.target.value.slice(0, 4);
        alert('Input cannot be more than 4 digits');
    }
});
    });
</script>s
@endsection
