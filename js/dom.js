const addBook = () => {
    const title = document.getElementById("inputBookTitle").value;
    const authorInput = document.getElementById("inputBookAuthor").value;
    const borrowerInput = document.getElementById("inputBorrower").value;
    const yearInput = document.getElementById("inputBookYear").value;
    const isCompleted = document.getElementById("inputBookIsComplete").checked;

    // Check if the author input contains only alphabetic characters
    if (!/^[a-zA-Z\s]+$/.test(authorInput)) {
        alert('Penulis harus berupa huruf alfabet dengan spasi.');
        return; // Exit the function if validation fails
    }

    // Check if the borrower input contains only alphabetic characters and spaces
    if (!/^[a-zA-Z\s]+$/.test(borrowerInput)) {
        alert('Peminjam harus berupa huruf alfabet dengan spasi.');
        return; // Exit the function if validation fails
    }

    // Check if the year input is exactly four digits
    if (!/^\d{4}$/.test(yearInput)) {
        alert('Tahun harus berupa angka dan terdiri dari empat digit.');
        return; // Exit the function if validation fails
    }
    const year = parseInt(yearInput, 10);
    const object = {
        id: +new Date(),
        title: title,
        author: authorInput,
        borrower: borrowerInput,
        year: year,
        isCompleted: isCompleted,
    };

    books.push(object);
    document.dispatchEvent(new Event(RENDER_EVENT));
    updateDataFromStorage();
};

const makeBook = (book) => {
    const bookItem = document.createElement("article");
    bookItem.classList.add("book-item");
    bookItem.innerHTML = "";
    let bookBorrower = book.borrower ? book.borrower : "";

    if (book.isCompleted) {
        bookItem.innerHTML = `
            <h3>${book.title}</h3>
            <p>Peminjam: ${bookBorrower}</p>
            <p>Penulis: ${book.author}</p>
            <p>Tahun: ${book.year}</p>
            <div class="action">
                <button class="incomplete" onclick="moveToUnCompleted(${book.id})">
                    - Belum Selesai
                </button>
                <button class="trash" onclick="removeBookFromBookshelf(${book.id})">
                    <img class="w-icon" src="assets/trash.png" />
                </button>
            </div>`;
    } else {
        bookItem.innerHTML = `
            <h3>${book.title}</h3>
            <p>Peminjam: ${bookBorrower}</p>
            <p>Penulis: ${book.author}</p>
            <p>Tahun: ${book.year}</p>
            <div class="action">
                <button class="complete" onclick="moveToCompleted(${book.id})">
                    + Selesai dibaca
                </button>
                <button class="trash" onclick="removeBookFromBookshelf(${book.id})">
                    <img class="w-icon" src="assets/trash.png" />
                </button>
            </div>`;
    }

    return bookItem;
};

const moveToCompleted = (bookId) => {
    const bookTarget = findBook(bookId);
    if (bookTarget == null) return;
    bookTarget.isCompleted = true;
    document.dispatchEvent(new Event(RENDER_EVENT));
    updateDataFromStorage();
};

const moveToUnCompleted = (bookId) => {
    const bookTarget = findBook(bookId);
    if (bookTarget === null) return;
    bookTarget.isCompleted = false;
    document.dispatchEvent(new Event(RENDER_EVENT));
    updateDataFromStorage();
};

const removeBookFromBookshelf = (bookId) => {
    const bookTarget = findBookIndex(bookId);
    if (bookTarget === -1) return;
    books.splice(bookTarget, 1);
    document.dispatchEvent(new Event(RENDER_EVENT));
    updateDataFromStorage();
};

const searchBook = (string) => {
    const bookItem = document.querySelectorAll(".book-item");
    for (const item of bookItem) {
        const title = item.childNodes[1];
        if (title.innerText.toUpperCase().includes(string)) {
            title.parentElement.style.display = "";
        } else {
            title.parentElement.style.display = "none";
        }
    }
};

const filterBook = (e) => {
    const bookshelfItem = document.querySelectorAll(".bookshelf-item");
    for (const bookshelf of bookshelfItem) {
        if (e == "all") {
            bookshelf.style.display = "";
            bookshelf.classList.remove("bookshelfByFilter");
        } else if (e == bookshelf.id) {
            bookshelf.style.display = "";
            bookshelf.classList.add("bookshelfByFilter");
        } else {
            bookshelf.style.display = "none";
        }
    }
};

const filters = document.querySelectorAll(".filter-book");
for (const filter of filters) {
    filter.addEventListener("click", () => {
        const active = document.querySelectorAll(".filter-active");
        for (const item of active) {
            item.className = item.className.replace("filter-active", "");
        }
        filter.classList.add("filter-active");
    });
}

const countBookshelf = () => {
    let complete = [];
    let incomplete = [];

    books.filter((book) => {
        if (book.isCompleted === true) {
            complete.push(book);
        } else {
            incomplete.push(book);
        }
    });

    document.getElementById("countAllBook").innerText = books.length;
    document.getElementById("countComplete").innerText = complete.length++;
    document.getElementById("countInComplete").innerText = incomplete.length++;
};

const inputSection = document.getElementById("inputSection");
const showInput = document.getElementById("showInput");
const hideInput = document.getElementById("hideInput");

showInput.addEventListener("click", () => {
    inputSection.style.display = "block";
    showInput.style.display = "none";
});

hideInput.addEventListener("click", () => {
    inputSection.style.display = "none";
    showInput.style.display = "flex";
});
