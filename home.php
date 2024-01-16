<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bookshelf</title>
        <link rel="stylesheet" href="css/index.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <header class="app-header">
            <div class="app-title">
                <img src="assets/bookshelf.png" alt="" />
                <h2>Bookshelf</h2>
            </div>
        </header>

        <main class="app-content">
            <section id="inputSection" class="input-section">
                <div class="input-head">
                    <h2>Tambah Buku</h2>
                    <button id="hideInput">
                        <img class="w-icon" src="assets/hide.png" alt="" />
                    </button>
                </div>
                <form id="inputBook">
                    <div class="input-item col">
                        <label for="inputBookTitle">Judul</label>
                        <input
                            id="inputBookTitle"
                            type="text"
                            placeholder="Masukan Judul Buku"
                            required
                        />
                    </div>
                    <div class="input-item col">
                        <label for="inputBookAuthor">Penulis</label>
                        <input
                            id="inputBookAuthor"
                            type="text"
                            placeholder="Masukan Nama Penulis"
                            required
                        />
                    </div>
                    <div class="input-item col">
                        <label for="inputBorrower">Peminjam</label>
                        <input
                            id="inputBorrower"
                            type="text"
                            placeholder="Masukan Nama Penulis"
                            required
                        />
                    </div>
                    <div class="input-item row">
                        <div class="input-item row">
                            <label for="inputBookYear">Tahun</label>
                            <input
                                id="inputBookYear"
                                type="number"
                                placeholder="2022"
                                required
                            />
                        </div>
                        <div class="input-item row">
                            <label for="inputBookIsComplete"
                                >Selesai dibaca</label
                            >
                            <input id="inputBookIsComplete" type="checkbox" />
                        </div>
                    </div>
                    <button type="submit">Masukan ke Rak Buku</button>
                </form>
            </section>

            <section class="bookshelf-section">
                <div class="bookshelf-filter">
                    <button id="showInput">
                        <img class="w-icon" src="assets/add.png" alt="" />
                        <p>Buku Baru</p>
                    </button>

                    <button
                        class="filter-book filter-active"
                        onclick="filterBook('all')"
                    >
                        <img class="w-icon" src="assets/book.png" alt="" />
                        <p>Semua Buku</p>
                        <span id="countAllBook">0</span>
                    </button>
                    <button
                        class="filter-book"
                        onclick="filterBook('incompleteBookshelf')"
                    >
                        <img class="w-icon" src="assets/open-book.png" alt="" />
                        <p>Belum Selesai</p>
                        <span id="countInComplete">0</span>
                    </button>
                    <button
                        class="filter-book"
                        onclick="filterBook('completeBookshelf')"
                    >
                        <img
                            class="w-icon"
                            src="assets/close-book.png"
                            alt=""
                        />
                        <p>Selesai dibaca</p>
                        <span id="countComplete">0</span>
                    </button>

                    <button
                        class="filter-"
                        onclick="filterBook('completeBookshelf')"
                    >
                        <img
                            class="w-icon"
                            src="assets/close-book.png"
                            alt=""
                        />
                        <p>Tabel</p>
                        <span id="countComplete">0</span>
                    </button>

                    <div class="search-book">
                        <label for="searchBookTitle">
                            <img
                                class="w-icon"
                                src="assets/search.png"
                                alt=""
                            />
                        </label>
                        <input
                            id="searchBookTitle"
                            type="text"
                            placeholder="Cari Buku..."
                        />
                    </div>
                </div>

                <div class="bookshelf-list">
                    <div id="incompleteBookshelf" class="bookshelf-item">
                        <h3>Belum Selesai dibaca</h3>
                        <div id="incompleteBookList" class="book-list"></div>
                    </div>

                    <div id="completeBookshelf" class="bookshelf-item">
                        <h3>Selesai dibaca</h3>
                        <div id="completeBookList" class="book-list"></div>
                    </div>
                </div>
            </section>
        </main>

        <!-- <form>
            <label for="username">Username</label>
            <input type="text" placeholder="username" id="username">
            <label for="password">Password</label>
            <input type="password" placeholder="password" id="password">
            <button>Register</button>
        </form>

        <form>
            <label for="username">Username</label>
            <input type="text" placeholder="username" id="username">
            <label for="password">Password</label>
            <input type="password" placeholder="password" id="password">
            <button>Register</button>
        </form> -->

        <script src="js/storage.js"></script>
        <script src="js/dom.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
