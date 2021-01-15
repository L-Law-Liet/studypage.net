@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="loading-image">
            <div class="justify-content-center d-flex row h-100">
                <img src="{{asset('img/loading.gif')}}">
            </div>
        </div>
        <div id="Resp" class="row">
        @include('filter')
        </div>
    </div>
    <script>
               function ajaxFilter(e) {
                    let arr = [];
                    if (['degreeSelect', 'oblSelect', 'dirSelect', 'incomeSelect'].includes(e.target.id)){
                        dopFilter(e);
                    }
                    var all = $(".ajax-filter").map(function() {
                        arr[$(this).attr('name')] = $(this).val();
                    });


                    if(e.target.getAttribute('name') == 'pageBtn') {
                        arr['pageBtn'] = parseInt(e.target.value);
                    }
                    else{
                        arr['pageBtn'] = null;
                    }
                   if(e.target.getAttribute('name') == 'pageBtn') {
                       arr['pageBtn'] = parseInt(e.target.value);
                   }
                   arr['programGroup'] = arr['programGroup[]'];
                   arr['learnProgram'] = arr['learnProgram[]'];
                   console.log(arr);
                    $('#loading-image').show();
                    $.ajax({
                        type : 'get',
                        url : '{{url('/ajax-filter', [$page, $query])}}',
                        data : {'a' : JSON.stringify(Object.assign ( {}, arr ))},
                        success:function (data) {
                            // console.log('success!--',data);
                            $('#Resp').html(data[0]);
                            $("#Subnav-LC").html(data[1]);
                            if (data[2] === 'university'){
                                if(!$("#UniActive").hasClass('active')){
                                    $("#UniActive").addClass('active');
                                    $("#CollegeActive").removeClass('active');
                                }
                            }
                            else if (data[2] === 'college'){
                                if(!$("#CollegeActive").hasClass('active')){
                                    $("#CollegeActive").addClass('active');
                                    $("#UniActive").removeClass('active');
                                }
                            }
                        },
                        complete: function() {
                            $('#loading-image').hide();
                        }
                    });
                }

               $('body').on('click', 'button.ajax-filter', function (e) {
                   ajaxFilter(e);
               });
               $("body").on('change', 'select.ajax-filter', function (e) {
                   console.log($("#pagination-select").val());
                   ajaxFilter(e);
               });
               $("body").on('change', 'input.ajax-filter', function (e) {
                   ajaxFilter(e);
               });

                function dopFilter(event) {
                        if (event.target.id === 'degreeSelect'){

                            document.getElementById('oblSelect').value = null;
                            document.getElementById('dirSelect').value = null;
                            document.getElementById('grupSelect').value = null;
                            document.getElementById('1profSelect').value = null;
                            document.getElementById('2profSelect').value = null;
                            document.getElementById('uniNameSelect').value = null;
                            if (event.target.value != '4'){
                                document.getElementById('lpSelect').value = null;
                            }
                            document.getElementById('uniTypeSelect').value = null;
                            document.getElementById('incomeSelect').value = null;
                            if (event.target.value === '1'){
                                document.getElementById('sferaSelect').value = null;
                            }
                            else if(event.target.value === '2'){
                            }
                            else if(event.target.value === '3'){
                            }
                            else if (event.target.value === '4'){
                                document.getElementById('oblSelect').value = null;
                                document.getElementById('dirSelect').value = null;
                                document.getElementById('grupSelect').value = null;
                                document.getElementById('sferaSelect').value = null;
                            }
                        }
                        if (event.target.id === 'incomeSelect'){
                                document.getElementById('1profSelect').value = null;
                                document.getElementById('2profSelect').value = null;
                        }
                        if (event.target.id === 'oblSelect'){
                                document.getElementById('dirSelect').value = null;
                                document.getElementById('grupSelect').value = null;
                        }
                        if (event.target.id === 'dirSelect'){
                                document.getElementById('grupSelect').value = null;
                        }
                }

               // jQuery(function () {
               //     jQuery("#pagination-select").change(function () {
               //         location.href = jQuery(this).val();
               //     });
               // })
    </script>
@endsection
