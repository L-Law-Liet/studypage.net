
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div>
            <span class="close">&times;</span>
        </div>
        <form action="{{route('payment')}}" method="post">
            @csrf
            <p>Сумма пополнения</p>
            <div class="dialog-input-div border-bottom p-0 d-flex justify-content-between">
                <input onkeypress='validate(event)' name="sum" oninput="minZero(event)" class="border-0 w-75" value="0" type="number" id="amountInput" title="Сумма пополнения"><div id="epayCurrency" class="w-25 dialog-valuta pt-2">&#8376;</div>
            </div>
            <div class="d-flex justify-content-between mt-2 mb-2 sums">
                <div onclick="setCash(event)" id="300" class="w-25 btn btns m-1 text-center p-1">300</div>
                <div onclick="setCash(event)" id="400" class="w-25 btn btns m-1 text-center p-1">400</div>
                <div onclick="setCash(event)" id="500" class="w-25 btn btns m-1 text-center p-1">500</div>
                <div onclick="setCash(event)" id="1000" class="w-25 btn btns m-1 text-center p-1">1000</div>
            </div>
            <div class="dialog-button-div mt-2 pt-1 mb-2">
                <button class="border-0 p-2">Оплатить</button>
            </div>
        </form>
    </div>

</div>
