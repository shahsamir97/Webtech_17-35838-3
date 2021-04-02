var cards = document.querySelector("#product_list")

cards.addEventListener('click', doSomething, false)

function doSomething(e){
    if (e.target !== e.currentTarget){
        alert("Clicked "+ e.target.id)
            window.location.href = "../view/product_view.php?productId="+e.target.id
            e.stopPropagation()
    }
}

