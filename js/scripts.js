/*!
* Start Bootstrap - The Big Picture v5.0.6 (https://startbootstrap.com/template/the-big-picture)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-the-big-picture/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

/* Sprawdzenie pola typu text, pod kątem zgodności z obiektem RegEx */
function sprawdzPole(pole_id, obiektRegex) {
    var obiektPole = document.getElementById(pole_id);
    if (!obiektRegex.test(obiektPole.value)) return (false);
    else return (true);
}
/* Sprawdzenie pola typu radio button */
function sprawdz_radio(nazwa_radio) {
    var obiekt = document.getElementsByName(nazwa_radio);
    for (i = 0; i < obiekt.length; i++) {
        wybrany = obiekt[i].checked;
        if (wybrany) return true;
    }
    return false;
}
/* Sprawdzenie pola typu checkbox */
function sprawdz_box(box_id) {
    var obiekt = document.getElementById(box_id);
    if (obiekt.checked) return true;
    else return false;
}
/* Sprawdzenie pola typu number */
function sprawdz_number(pole_id) {
    var obiekt = document.getElementById(pole_id).value;
    if (obiekt > 0 && obiekt < 120) {
        return true;
    }
    return false;
}
/* Sprawdzenie czy wszystkie pola zostały wypełnione */
function sprawdz() {
    var poprawny = true;
    regImie = /^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}$/;
    regNazwisko = /^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,40}$/;
    regEmail = /^(([\w_]+)-*\.?)+@[\w](([\w]+)-?_?\.?)+([a-z]{2,4})$/;
    //sprawdzenie imienia
    if (!sprawdzPole("imie", regImie)) {
        poprawny = false;
        document.getElementById("imie_error").innerHTML = "Wpisz poprawne imię!";
    }
    else document.getElementById("imie_error").innerHTML = "";
    //sprawdzenie nazwiska
    if (!sprawdzPole("nazwisko", regNazwisko)) {
        poprawny = false;
        document.getElementById("nazwisko_error").innerHTML = "Wpisz poprawnie nazwisko!";
    }
    else document.getElementById("nazwisko_error").innerHTML = "";
    //sprawdzenie wieku
    if (!sprawdz_number("wiek")) {
        poprawny = false;
        document.getElementById("wiek_error").innerHTML = "Wpisz poprawny wiek!";
    }
    else document.getElementById("wiek_error").innerHTML = "";
    //sprawdzenie emaila
    if (!sprawdzPole("email", regEmail)) {
        poprawny = false;
        document.getElementById("email_error").innerHTML = "Wpisz poprawnie email!";
    }
    else document.getElementById("email_error").innerHTML = "";
    //sprawdzenie zainteresowan
    if (!sprawdz_box("sklep") && !sprawdz_box("wydarzenia") && !sprawdz_box("wiesci")) {
        poprawny = false;
        document.getElementById("zainteresowania_error").innerHTML = "Musisz wybrać główne zainteresowania!";
    }
    else document.getElementById("zainteresowania_error").innerHTML = "";
    //sprawdzenie czestotliwosci
    if (!sprawdz_radio("czestotliwosc")) {
        poprawny = false;
        document.getElementById("czestotliwosc_error").innerHTML = "Musisz wskazać częstotliwość wysyłania!";
    }
    else document.getElementById("czestotliwosc_error").innerHTML = "";
    return poprawny;
}
/* Wyświetlenie komunikatu z podanymi danymi */
function pokazDane() {
    if (!sprawdz()) return false;
    // Dodanie wartości z pól
    var dane = "Dane z wypełnionego przez Ciebie formularza:\n";
    dane += "Imie: " + document.getElementById('imie').value + "\n";
    dane += "Nazwisko: " + document.getElementById('nazwisko').value + "\n";
    dane += "Wiek: " + document.getElementById("wiek").value + "\n";
    dane += "Kraj: " + document.getElementById("kraj").value + "\n";
    dane += "Email: " + document.getElementById("email").value + "\n";
    dane += "Wybrane zainsteresowania: ";
    // Zweryfikowanie checkbox
    var obiekt_box = document.getElementById("sklep");
    if (obiekt_box.checked) dane += "Nowości w sklepie ";
    obiekt_box = document.getElementById("wydarzenia");
    if (obiekt_box.checked) dane += "Wydarzenia specjalne ";
    obiekt_box = document.getElementById("wiesci");
    if (obiekt_box.checked) dane += "Wieści od członków zespołu ";
    dane += "\n";
    dane += "Częstotliwość wysyłania: ";
    // Zweryfikowanie radio button
    var obiekt = document.getElementsByName("czestotliwosc");
    for (i = 0; i < obiekt.length; i++) {
        wybrany = obiekt[i].checked;
        if (wybrany) dane += obiekt[i].value;
    }
    if (window.confirm(dane)) return true;
    else return false;
}
/* Dzięki OpenWeatherMap API pobieramy informację o pogodzie na podstawie lokalizacji użytkownika */
function pobierzPogode(szerokosc_geo, dlugosc_geo) {
    var apiKey = '33e0a712108f726772e5267df086ff06'; // Klucz API
    /* Link do pobrania pogody na podstawie zmiennych lat i lon oznaczających szerokość i długość geograficzną użytkownika. */
    var url = `https://api.openweathermap.org/data/2.5/weather?lat=${szerokosc_geo}&lon=${dlugosc_geo}&appid=${apiKey}&units=metric`;
    /* Dodanie "&units=metric" na końcu zmienia jednostkę temperatury na celsjusze */
    console.log(url);

    /* Pobieramy odpowiedź od strony, res to odpowiedź od API */
    fetch(url).then(res => res.json()).then(res => {
        console.log(res);
        var temperatura = res.main.temp;
        var cisnienie = res.main.pressure;
        var wilgotnosc = res.main.humidity;
        var pogoda = res.weather[0].main;
        var opis = res.weather[0].description;
        var ikona = res.weather[0].icon;
        document.getElementById("pogoda").innerHTML = `Pogoda: ${pogoda}, Temperatura: ${temperatura} C, Opis: ${opis}, Ciśnienie: ${cisnienie} hPa, Wilgotność: ${wilgotnosc} %`;
        document.getElementById("ikona").src = `https://openweathermap.org/img/wn/${ikona}@2x.png`;
    }).catch(err => console.log(err));
}
/* Utworzenie mapy i markera na podstawie pobranej lokalizacji */
function pokazLokalizacje(pozycja) {
    var szerokosc_geo = pozycja.coords.latitude;
    var dlugosc_geo = pozycja.coords.longitude;
    var wspolrzedne = new google.maps.LatLng(szerokosc_geo, dlugosc_geo);
    var opcjeMapy = {
        zoom: 10,
        center: wspolrzedne,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    /* Utworzenie mapy */
    var mapa = new google.maps.Map(document.getElementById("mapa"), opcjeMapy);
    /* Utworzenie obiektu, na podstawie którego będzie utworzony marker */
    var lokalizacja_markera = {
        lat: szerokosc_geo,
        lng: dlugosc_geo
    }
    new google.maps.Marker({
        position: lokalizacja_markera,
        map: mapa
    });
    /* Uruchomienie funkcji obsługującej pogodę */
    pobierzPogode(szerokosc_geo, dlugosc_geo);
}
/* Obsługa błędów */
function errorHandler(error) {
    var wiadomosc = document.getElementById("mapa");
    switch (error.code) {
        case error.PERMISSION_DENIED:
            wiadomosc.innerHTML = "Użytkownik nie udostępnił danych.";
            break;
        case error.POSITION_UNAVAILABLE:
            wiadomosc.innerHTML = "Dane lokalizacyjne niedostępne.";
            break;
        case error.TIMEOUT:
            wiadomosc.innerHTML = "Przekroczono czas żądania.";
            break;
        case error.UNKNOWN_ERROR:
            wiadomosc.innerHTML = "Wystąpił nieznany błąd.";
            break;
    }
}
/* Pobranie lokalizacji, która zostanie albo przekierowana do utworzenia mapy albo do obsłużenia błędów */
function pobierzLokalizacje() {
    if (navigator.geolocation) {
        var options = { timeout: 60000 };
        navigator.geolocation.getCurrentPosition(
            pokazLokalizacje,
            errorHandler,
            options);
    } else { alert("Twoja przeglądarka nie wspiera geolokalizacji!"); }
}
/* Zapisanie stanu pól w formularzu. Imie jest zapisywane jako klucz, dlatego jest wymagane */
function zapiszStan() {
    var formularz = {};
    document.getElementById('imie_error').innerHTML = "";
    if (document.getElementById('imie').value === "") {
        document.getElementById('imie_error').innerHTML = "Podaj imię aby przejść do edycji";
    } else {
        formularz.imie = document.getElementById('imie').value;
        formularz.nazwisko = document.getElementById('nazwisko').value;
        formularz.wiek = document.getElementById('wiek').value;
        formularz.kraj = document.getElementById('kraj').value;
        formularz.email = document.getElementById('email').value;
        localStorage.setItem(formularz.imie, JSON.stringify(formularz));
    }
}
/* Na podstawie klucza (imienia), zostają wyświetlone zapisane pola w przypisanych ich miejscach */
function pokazFormularz() {
    document.getElementById('imie_error').innerHTML = "";
    if (document.getElementById('imie').value === "") {
        document.getElementById('imie_error').innerHTML = "Podaj imię aby zobaczyć formularz";
    } else {
        var formularz = JSON.parse(localStorage.getItem(document.getElementById('imie').value));
        document.getElementById('nazwisko').value = formularz.nazwisko;
        document.getElementById('wiek').value = formularz.wiek;
        document.getElementById('email').value = formularz.email;
    }
}
/* Zmodyfikowanie wartości danych, na podstawie klucza (imienia) */
function zmodyfikujStan() {
    var formularz = {};
    document.getElementById('imie_error').innerHTML = "";
    if (document.getElementById('imie').value === "") {
        document.getElementById('imie_error').innerHTML = "Podaj imię aby przejść do edycji";
    } else {
        var poprzedni_formularz = JSON.parse(localStorage.getItem(document.getElementById('imie').value));
        if (poprzedni_formularz === null) {
            document.getElementById('imie_error').innerHTML = "Podaj imię zapisanego formularza";
            return;
        }
        /* Zakładamy, że imię jest zawsze poprawne */
        var temp = document.getElementById('imie').value;
        formularz.imie = temp;
        /* Dalej sprawdzamy, czy wprowadzone dane są puste, czy nie. W przypadku gdy wartość nie jest pusta zapisywane są nowe dane */
        temp = document.getElementById('nazwisko').value;
        formularz.nazwisko = temp === "" ? poprzedni_formularz.nazwisko : temp;

        temp = document.getElementById('wiek').value;
        formularz.wiek = temp === "" ? poprzedni_formularz.wiek : temp;

        temp = document.getElementById('kraj').value;
        formularz.kraj = temp === "" ? poprzedni_formularz.kraj : temp;

        temp = document.getElementById('email').value;
        formularz.email = temp === "" ? poprzedni_formularz.email : temp;

        localStorage.setItem(formularz.imie, JSON.stringify(formularz));
    }
}
/* Usuwanie wszystkich danych lokalnych */
function usunDane() {
    document.getElementById('imie_error').innerHTML = "";
    localStorage.clear();
}

//Obsługa sklepu i koszyka
function getCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}
function calculateTotal() {
    const cart = getCart();
    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    return total.toFixed(2);
}
function displayCart() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartItemsContainer.innerHTML = '';

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>Koszyk jest pusty</p>';
        return;
    }

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <button class="btn btn-outline-light" onclick="removeAllFromCart(${item.id})">X</button>
            <span>${item.name}</span> - 
            <span>${item.price.toFixed(2)} zł</span> - 
            <span>Ilość: ${item.quantity}</span>
            <button class="btn btn-outline-light" onclick="removeFromCart(${item.id})">Usuń jeden</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });
    cartTotal.textContent = `Całkowita wartość: ${calculateTotal()} zł`;
}
document.addEventListener('DOMContentLoaded', displayCart);
function addToCart(product) {
    const cart = getCart();
    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ id: product.id, name: product.name, price: parseFloat(product.price), quantity: 1 });
    }

    saveCart(cart);
    console.log('Dodano do koszyka:', product);
    displayCart();
}
function removeFromCart(productId) {
    var cart = getCart();
    const productIndex = cart.findIndex(item => item.id === productId);

    if (productIndex !== -1) {
        if (cart[productIndex].quantity > 1) {
            cart[productIndex].quantity -= 1;
        } else {
            cart.splice(productIndex, 1);
        }
    }

    saveCart(cart);
    console.log(`Usunięto jeden produkt o ID ${productId} z koszyka`);
    displayCart();
    
    cart = getCart();
    if (cart.length === 0) {
        const cartTotal = document.getElementById('cart-total');
        cartTotal.textContent = `Całkowita wartość: 0.00 zł`;
    }
}
function removeAllFromCart(productId) {
    var cart = getCart();
    const updatedCart = cart.filter(item => item.id !== productId);

    saveCart(updatedCart);
    console.log(`Usunięto wszystkie produkty o ID ${productId} z koszyka`);
    displayCart();

    cart = getCart();
    if (cart.length === 0) {
        const cartTotal = document.getElementById('cart-total');
        cartTotal.textContent = `Całkowita wartość: 0.00 zł`;
    }
}
function clearCart() {
    localStorage.removeItem('cart');
    const cartTotal = document.getElementById('cart-total');
    cartTotal.textContent = `Całkowita wartość: 0.00 zł`;
    console.log('Koszyk wyczyszczony');
    displayCart();
}
function getCartSummary() {
    const cart = getCart();
    if (cart.length === 0) {
        return "Koszyk jest pusty.";
    }

    let summary = "";
    cart.forEach(item => {
        summary += `${item.name}, ilość: ${item.quantity}, cena: ${(item.price * item.quantity).toFixed(2)} zł | `;
    });
    let sum = summary.slice(0, -3);
    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    
    return {
        description: sum,
        price: total
    };
}
function purchaseCart() {
    const cartSummary = getCartSummary().description;
    const cartTotal = getCartSummary().price;

    fetch('./zakup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            summary: cartSummary,
            total: cartTotal,
        }),
    })
    .then(response => {return response.json();})
    .then(data => {
        if (data.success) {
            alert("Zakup zakończony sukcesem!");
            clearCart();
        } else {
            alert("Błąd podczas realizacji zakupu: " + data.error);
        }
    })
    .catch(error => {
        console.error("Błąd:", error);
        alert("Nie udało się zrealizować zakupu.");
    });
}
//Obsługa zamówień
function changeDeliveryStatus(status, id) {
    const deliveryStatus = status;
    const deliveryId = id;
    fetch('./aktualizuj.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            status: deliveryStatus,
            id: deliveryId
        }),
    })
    .then(response => {return response.json();})
    .then(data => {
        if (data.success) {
            alert("Status został zaktualizowany");
            location.reload(true);
        } else {
            alert("Błąd podczas aktualizacji statusu: " + data.error);
        }
    })
    .catch(error => {
        console.error("Błąd:", error);
        alert("Nie udało się zaktualizować statusu");
    });
}
