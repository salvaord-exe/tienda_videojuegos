document.getElementById('precio_producto').value = parseFloat(document.getElementById('precio-producto').textContent);


let restarCant = document.getElementById('restar-cant').addEventListener('click', function(event) {
    event.preventDefault();
    let cantProducto = funcRestarCant('cant-carrito');
    funcCalcSubtotal(cantProducto);
    if (cantProducto == 0) {
        document.getElementById('agregar_carrito').disabled = true;
    } else {
        document.getElementById('agregar_carrito').disabled = false;
    }
}, false);

let sumarCant = document.getElementById('sumar-cant').addEventListener('click', function(event) {
    event.preventDefault();
    let cantProducto = funcSumarCant('cant-carrito');
    funcCalcSubtotal(cantProducto);
    if (cantProducto == 0) {
        document.getElementById('agregar_carrito').disabled = true;
    } else {
        document.getElementById('agregar_carrito').disabled = false;
    }
}, false);



function funcRestarCant(idCantidad) {

    let cantCarrito = document.getElementById(idCantidad);
    let varCantidad = parseInt(cantCarrito.textContent);
    if (varCantidad > 0) {
        --varCantidad;
        cantCarrito.textContent = varCantidad;
        document.getElementById('cantidad_producto').value = varCantidad;
    }

    return varCantidad;
}

function funcSumarCant(idCantidad) {
    let cantCarrito = document.getElementById(idCantidad);
    let varCantidad = parseInt(cantCarrito.textContent);
    ++varCantidad;
    cantCarrito.textContent = varCantidad;
    document.getElementById('cantidad_producto').value = varCantidad;

    return varCantidad;
}

function funcCalcSubtotal(cantProducto) {
    cantProducto = parseFloat(cantProducto);
    subProducto = document.getElementById('sub-carrito');
    precioProducto = parseFloat(document.getElementById('precio-producto').textContent);
    varSubProducto = cantProducto * precioProducto;
    varSubProducto = Math.round((varSubProducto + Number.EPSILON) * 100) / 100;
    subProducto.textContent = varSubProducto;
    document.getElementById('subtotal_producto').value = varSubProducto;
}