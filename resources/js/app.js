import './bootstrap';

const queryInput = document.querySelector('.search-q');
queryInput?.addEventListener('input', async ()=>{
    document.querySelector('.search-result')?.remove();

    const value = queryInput.value;
    if(value.length < 2) return;

    const response = await axios({
        method: 'get',
        url: '/search-ajax?q='+value,
    });

    /* const {data, total} = response.data;
    let html='<div class="search-result">';
    data.forEach(catalog => {
        html+= `
            <div class='row'>
                <div class='col-4'>
                <img src='${catalog.image}' alt='${catalog.title}'>
                </div>
                <div class='col-8'>
                ${catalog.title}
                </div>
            </div>
        `;
    });
    html += '</div>';

    document.querySelector('.search-form').insertAdjacentHTML('beforeend', html); */
    
    const {data, total} = response.data;

    let html='<div class="search-result">';

    data.forEach(catalog => {
        const titleWords = catalog.title.split(' ').slice(0, 4);
        const shortenedTitle = titleWords.join(' ');
        html+= `
            <a href="/catalog/readMore/${catalog.id}">
                <div class='row my-2'>
                    <div class='col-4'>
                        <img src='${catalog.image}' alt='${catalog.title}'>
                    </div>
                    <div class='col-8'>
                        ${shortenedTitle} <br>
                        ${catalog.price} $ <br>
                    </div>
                </div>
            </a>
        `;
    });
    html += `<strong><a href='/search?q=${value}'>Total: ${total}</a></strong></div>`;

document.querySelector('.search-form').insertAdjacentHTML('beforeend', html);
})

document.addEventListener('click', (event)=>{
    document.querySelector('.search-result')?.remove();
})



$(document).ready(function() {
    if ($('.slider').length != 0) {
        $('.slider').slick({
            dots: true, // показывать точки-индикаторы
            autoplay: true, // автопрокрутка слайдов
            autoplaySpeed: 5000, // скорость автопрокрутки в миллисекундах
            slidesToShow: 5,
            responsive: [
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
    }
});


if($(".js-range-slider").length!=0){
    $(".js-range-slider").ionRangeSlider({onChange: (data) => {
    document.getElementById("min-price").value = data.from
    document.getElementById("max-price").value = data.to
}});
}


document.getElementById("min-price")?.addEventListener("keydown", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
});

document.getElementById("max-price")?.addEventListener("keydown", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
});

document.querySelector("#min-price")?.addEventListener('change', ()=>{
    let from_price = document.querySelector("#min-price").value;
    let to_price = document.querySelector("#max-price").value;
    let my_range = $(".js-range-slider").data("ionRangeSlider");
    my_range.update({
        from: from_price,
        to: to_price
    });
    
    my_range.reset();
})

document.querySelector("#max-price")?.addEventListener('change', ()=>{
    let from_price = document.querySelector("#min-price").value;
    let to_price = document.querySelector("#max-price").value;
    let my_range = $(".js-range-slider").data("ionRangeSlider");
    my_range.update({
        from: from_price,
        to: to_price
    });
    
    my_range.reset();
})

document.querySelector(".irs-from")?.addEventListener('change', ()=>{
    let from_price = document.querySelector(".irs-from").value;
    let to_price = document.querySelector(".irs-to").value;
    console.log(from_price);
})


// Получаем все input в таблице

var myTextarea = document.getElementById("myTextarea");
    myTextarea?.addEventListener("keydown", function(event) {
        if (event.keyCode === 13) {
        event.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;
        this.value = this.value.substring(0, start) + "<br>" + this.value.substring(end);
        this.setSelectionRange(start + 4, start + 4);
    }
});



// Quantity Cart ---------------------------------
$(document).ready(function() {
    // Установка CSRF-токена в заголовок каждого AJAX-запроса
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    // Обработчик события change для элемента с классом input-quantity
    $('.input-quantity').on('change', function() {
      var quantity = $(this).val();
      var productId = $(this).data('product-id');
      
      $.ajax({
        url: '/carts/quantity',
        type: 'POST',
        data: { quantity: quantity, productId: productId },
        success: function(response) {
            console.log(response);
            var totalPrice = response.totalPrice;
            document.getElementById('totalPrice').innerHTML = 'Total: ' + totalPrice + ' USD';
            document.getElementById('totalSubtotal').innerHTML = 'Cart subtotal: ' + totalPrice + ' USD';
            //document.getElementById('subtotal').innerHTML =  totalPrice * response.quantity + ' $';
            // Дополнительные действия после успешного выполнения запроса
        },
        error: function(xhr) {
          console.log(xhr.responseText);
          // Обработка ошибки
        }
      });
    });
});





// Mailing ------------------------------------

// Получаем форму по ее идентификатору
var form = document.getElementById('mailingForm');

// Добавляем обработчик события отправки формы
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Отменяем стандартное поведение отправки формы

    // Создаем объект FormData и добавляем данные формы
    var formData = new FormData(form);

    // Создаем новый объект XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Настраиваем запрос
    xhr.open('POST', form.action, true);

    // Определяем обработчик события загрузки
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Запрос успешно выполнен
            // Можете выполнить дополнительные действия после успешного выполнения запроса
            // Например, очистить поля формы или отобразить сообщение об успешной отправке
            form.reset();
        } else {
            // Произошла ошибка при выполнении запроса
            // Можете обработать ошибку или вывести сообщение об ошибке
        }
    };

    // Отправляем запрос с данными формы
    xhr.send(formData);
});