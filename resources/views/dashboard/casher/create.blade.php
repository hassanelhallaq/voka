 <x-default-layout>

     <div class="card card-custom">



         <div class="card-header">



             <div class="card-toolbar">

                 <div class="example-tools justify-content-center">

                     <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                     <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

                 </div>

             </div>

         </div>



         <form class="form" method="post" id='create_form'>
             @csrf
             <div class="card-body">
                 <div class="row">

                     <div class="form-group col-md-6">

                         <label><strong>Date</strong></label>

                         <input type="date" id="date" class="form-control form-control-solid"
                             placeholder="date" />

                     </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-md-6">
                         <label>cash z:</label>

                         <input type="number" id="cash" value="{{ $reservation }}" onInput="expensesSum()"
                             class="form-control form-control-solid invalid" placeholder="cash z" />

                     </div>
                 </div>
                 <div class="row">

                     <div class="form-group col-md-6">

                         <label> cash found:</label>

                         <input type="number" id="cash_found" onInput="expensesSum()"
                             class="form-control form-control-solid" placeholder="cash found" />

                     </div>
                     <div class="form-group col-md-6">

                         <label> expenses sum:</label>

                         <input type="number" id="expenses_sum" onInput="expensesSum()"
                             class="form-control form-control-solid" placeholder="expenses sum" />

                     </div>



                 </div>


                 <hr>
                 <div class="row">

                     <div class="form-group col-md-6">

                         <label> credit z:</label>

                         <input type="number" id="credit" class="form-control form-control-solid"
                             placeholder=" credit z" />

                     </div>
                     <div class="form-group col-md-6">

                         <label> credit trans:</label>

                         <input type="number" onInput="creditTrans()" id="credit_trans"
                             class="form-control form-control-solid" onInput="creditTrans()"
                             placeholder="credit trans" />

                     </div>
                     <div class="form-group col-md-6">

                         <label>remarks</label>

                         <textarea type="text" id="remarks" class="form-control form-control-solid" placeholder="remarks"></textarea>

                     </div>
                 </div>

                 <hr>
                 <div class="card-footer">

                     <button type="button" onclick="performStore()" id="save"
                         class="btn btn-primary mr-2">{{ __('Submit') }}</button>



                 </div>

             </div>

         </form>



         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

         <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

         <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
         <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCZ1R13uqV5VpKRcWAN8YpL5T3XsBASBXo"></script>

         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

         <script src="{{ asset('crudjs/crud.js') }}"></script>


         <script>
             function expensesSum() {


                 var cash_found = parseFloat(document.getElementById("cash_found").value);
                 var expenses_sum = parseFloat(document.getElementById("expenses_sum").value);

                 var cash = document.getElementById('cash').value;
                 var cash_foundInput = document.getElementById('cash_found');
                 var expenses_sumInput = document.getElementById('expenses_sum');

                 var sum = cash_found + expenses_sum;
                 if (sum != cash) {
                     expenses_sumInput.style.backgroundColor = '#ff0000';

                     cash_foundInput.style.backgroundColor = '#ff0000';
                     return false;
                 }
                 if (sum == cash) {
                     expenses_sumInput.style.backgroundColor = '#ffffff';

                     cash_foundInput.style.backgroundColor = '#ffffff';
                     return true;
                 }

             }

             function creditTrans() {

                 var credit = parseFloat(document.getElementById("credit").value);
                 var credit_trans = parseFloat(document.getElementById("credit_trans").value);

                 var credit_transInput = document.getElementById('credit_trans');

                 if (credit != credit_trans) {
                     credit_transInput.style.backgroundColor = '#ff0000';
                     return false;

                 }
                 if (credit == credit_trans) {

                     credit_transInput.style.backgroundColor = '#ffffff';
                     return true;
                 }

             }

             function vouchersIn() {

                 var vouchers = parseFloat(document.getElementById("vouchers").value);
                 var vouchers_trans_1 = parseFloat(document.getElementById("vouchers_trans_1").value);
                 var vouchers_trans_2 = parseFloat(document.getElementById("vouchers_trans_2").value);


                 var vouchers_trans_2Input = document.getElementById('vouchers_trans_2');
                 var vouchers_trans_1Input = document.getElementById('vouchers_trans_1');

                 if (vouchers_trans_1 + vouchers_trans_2 != vouchers) {
                     vouchers_trans_2Input.style.backgroundColor = '#ff0000';
                     vouchers_trans_1Input.style.backgroundColor = '#ff0000';

                     return false;

                 }
                 if (vouchers_trans_1 + vouchers_trans_2 == vouchers) {
                     vouchers_trans_2Input.style.backgroundColor = '#ffffff';
                     vouchers_trans_1Input.style.backgroundColor = '#ffffff';
                     return true;
                 }

             }
             var avatar1 = new KTImageInput('kt_image_1');

             function performStore() {
                 let formData = new FormData();
                 formData.append('cash', document.getElementById('cash').value);
                 formData.append('cash_found', document.getElementById('cash_found').value);
                 formData.append('expenses_sum', document.getElementById('expenses_sum').value);
                 formData.append('credit', document.getElementById('credit').value);
                 formData.append('credit_trans', document.getElementById('credit_trans').value);
                 formData.append('date', document.getElementById('date').value);
                 formData.append('remarks', document.getElementById('remarks').value);
                 storeRedirect('/admin/cashers', formData, '/admin/cashers')


             }
         </script>



 </x-default-layout>
