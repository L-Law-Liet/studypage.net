$(document).ready(function() {

	var CSRF_TOKEN = $('input[name="_token"]').val();
	var ajax = 'none';

	$('.show-modal').on('click', function(){
			$('iframe').attr('src', $(this).attr('data-src'));
	});
	$("#sliderModal").on("hidden.bs.modal", function () {
			$('iframe').attr('src', '');
	});

	if ($('#degree_id').val() === '1') {
		$('.bK').addClass('active');
	} else if ($('#degree_id').val() === '2') {
		$('.mG').addClass('active');
	} else if ($('#degree_id').val() === '3') {
		$('.dK').addClass('active');
	}


	$('td').each(function () {
			$(this).css('width', '');
			$(this).css('height', '');
	});


	var dDegree = 0;
	var degUrl = 'any';
	var dDirection_id = 0;
	var dirUrl = 'any';
	var dCity_id = 0;
	var citUrl = 'any';
	var dQuery = 'none';
	$('body').on('change', '#st', function (e) {
		dDegree = e.target.value;
		if (e.target.value !== undefined && e.target.value !== '' && e.target.value !== 0 && e.target.value !== '0') {
			degUrl = $(this).find(':selected').data('name');
		} else {
			degUrl = 'any';
		}
		ChangeCount();
	});
	$('body').on('change', '#dr', function (e) {
		dDirection_id = e.target.value;
		if (e.target.value !== undefined && e.target.value !== '' && e.target.value !== 0 && e.target.value !== '0') {
			dirUrl = $(this).find(':selected').data('url');
		} else {
			dirUrl = 'any';
		}
		ChangeCount();
	});
	$('body').on('change', '#ct', function (e) {
		dCity_id = e.target.value;
		if (e.target.value !== undefined && e.target.value !== '' && e.target.value !== 0 && e.target.value !== '0') {
			citUrl = $(this).find(':selected').data('url');
		} else {
			citUrl = 'any';
		}
		ChangeCount();
	});
	$('#si').on('keyup', function () {
		if (this.value.length >= 1) {
			dQuery = this.value;
		} else {
			dQuery = 'none';
		}
		ChangeCount();
	});
	function ChangeCount () {
		if (dDegree === undefined || dDegree === '' || dDegree === null){
			dDegree = 0;
		}
		$.ajax({
			type: 'GET',
			url: '/fmain/' + dDegree + '/' + dDirection_id + '/' + dCity_id + '/' + dQuery,
			success: function (data) {
				$('.cc').html(data);
			}
		})
	};

	$('body').on('click', '.goSearch', function (e) {
		e.preventDefault();
		if (document.getElementById('st').value > 0){
			if (dQuery != undefined && dQuery !== 'none' && dQuery != '') {
				window.location.href = '/poisk?degree_id=' + dDegree + '&direction_id=' + dDirection_id + '&subdirection_id=any&specialty_id=any&city_id=' + dCity_id + '&pr1=any&pr2=any&un_id=any&type_id=any&search=' + dQuery + '&page=1';
			} else {
				window.location.href = '/poisk?degree_id=' + dDegree + '&direction_id=' + dDirection_id + '&subdirection_id=any&specialty_id=any&city_id=' + dCity_id + '&pr1=any&pr2=any&un_id=any&type_id=any&page=1';
			}
		}
		else {
			$('#Zearch').trigger('click');
		}
	});
	function bgGG(){
		document.getElementById('st').style.background = '#fff';
	}
	$('#degree_id').on('change', function() {
		ChangeUrl('page', '1');
		$('.dC').removeClass('active');
		SearchAjax('degree_id', this.value);
		var inputs = document.querySelectorAll('.subject');
		if (this.value != 1) {
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].checked = false;
			}
		}
		if (this.value === 'bakalavriat') {
			$('.bK').addClass('active');
		} else if (this.value === 'magistratura') {
			$('.mG').addClass('active');
		} else if (this.value === 'doktorantura') {
			$('.dK').addClass('active');
		}
		if(this.value == 'bakalavriat' || this.value == ''){
			$('.discipline').css('display', 'block');
			$('.sphere').css('display', 'none');
		} else{
			$('.discipline').css('display', 'none');
			$('.sphere').css('display', 'block');
		}
	});

	$('#direction_id').on('change', function() {
		ChangeUrl('page', '1');
		var th = this;
		if (th.value === 'any' || th.value == '') {
			$("#subdirection_id").val("any");
			$("#specialty_id").val("any");
			$("#direction_id").val("any");
			ChangeUrl('direction_id', 'any');
			ChangeUrl('subdirection_id', 'any');
			$('#subdirection').hide();
			$('#specialty').hide();
		}
		if (ajax != 'none') {
			ajax.abort();
			ajax = 'none';
		}
		ajax = $.ajax({
			type: "POST",
			url: "/ajax/subdirection",
			dataType: "json",
			data: {
				_token: CSRF_TOKEN, 'direction_id': th.value
			},
			status: $('.nPreloader').css('display', 'flex'),
			success: function (data) {
				if (data !== 'any') {
					$(".subdirection option").remove();
					$('.subdirection').append(data);
					$('#subdirection').show();
					UpdateS();
				}
				SearchAjax('direction_id', th.value);
			},
			error: function () {
				console.log('error!');
				$('.nPreloader').css('display', 'none');
			}
		});
	});

	$('.subdirection').on('change', function() {
		ChangeUrl('page', '1');
		var th = this;
		if (th.value === 'any' || th.value == '') {
			$('#specialty').hide();
		}
		if (ajax != 'none') {
			ajax.abort();
			ajax = 'none';
		}
		ajax = $.ajax({
			type: "POST",
			url: "/ajax/specialties",
			dataType: "json",
			data: {_token: CSRF_TOKEN, 'degree_id':$('#degree_id').val(), 'subdirection_id': th.value},
			status: $('.nPreloader').css('display', 'flex'),
			success: function (data) {
				if (data !== 'any') {
					$('#specialty').show();
					$(".specialty option").remove();
					$('.specialty').append(data);
					UpdateS();
				}
				$('.nPreloader').css('display', 'none');
				SearchAjax('subdirection_id', th.value);
			},
			error: function () {
				console.log('error!');
				$('.nPreloader').css('display', 'none');
			}
		});

	});


	$('#city_id').on('change', function() {
		ChangeUrl('page', '1');
		var th = this;
		if (ajax != 'none') {
			ajax.abort();
			ajax = 'none';
		}
		ajax = $.ajax({
			type: "POST",
			url: "/ajax/un",
			dataType: "json",
			status: $('.nPreloader').css('display', 'flex'),
			data: {_token: CSRF_TOKEN, 'city_id': th.value},
			success: function (data) {
				$(".un option").remove();
				$('.un').append(data);
				UpdateS();
				$('.nPreloader').css('display', 'none');
				SearchAjax('city_id', th.value);
			},
			error: function () {
				console.log('error!');
				$('.nPreloader').css('display', 'none');
			}
		});
	});


	function SearchAjax (param, value) {
			var degree_id = $('#degree_id').val();
			var subdirection_id = $('#subdirection_id').val();
			var city_id = $('#city_id').val();
			var direction_id = $('#direction_id').val();
			var type_id = $('#type_id').val();
			var sort = $('#sortorder').val();
			var program_id = $('#program_id').val();
			var un = $('#un_id').val();
			var search = $('#rsearch').val();
			var subject_id = [];
			$("input[name='subject_id']:checked").each(function (i) {
				subject_id[i] = $(this).val();
			});
			if (ajax != 'none') {
				ajax.abort();
				ajax = 'none';
			}
			var specialty_id = $('#specialty_id').val();
			ajax = $.ajax({
				url: "/ajax/specialty",
				status: $('.nPreloader').css('display', 'flex'),
				data: {
					_token:CSRF_TOKEN,
					degree_id:degree_id, //Степень
					direction_id:direction_id, //Направление обучения
					subdirection_id:subdirection_id, //Группа специальностей
					city_id:city_id, //Город
					subject_id:subject_id, //Профильный предмет
					type_id:type_id, //Тип заведения
					sort:sort, //Сортировка
					program_id:program_id, //Сфера обучения
					un_id:un, //Университет
					search:search, //Строка поиска,
          specialty_id:specialty_id
				}
			}).done(function(data){
				$('.result').html(data);
				$('.nPreloader').css('display', 'none');
				ChangeUrl(param, value);
				UpdateS();
			})
		}


    $('.specialty').on('change', function() {
      SearchAjax('specialty_id', this.value);
       //  var specialty_id = this.value;
       //  var degree_id = $('#degree_id').val();
       //  var subdirection_id = $('#subdirection_id').val();
       //  var state_id = $('#state_id').val();
       //  var city_id = $('#city_id').val();
       //  var subject_id = [];
       //  $("input[name='subject_id']:checked").each(function (i) {
       //      subject_id[i] = $(this).val();
       //  });
       //  var type_id = $('#type_id').val();
       //  var form_education_id = $('#form_education_id').val();
       //  var sort = $('#sortorder').val();
			// var direction_id = $('#direction_id').val();
			// var search = $('#rsearch').val();
      //
			// var program_id = $('#program_id').val();
			// var un = $('#un_id').val();
      //
			// if (ajax != 'none') {
			// 	ajax.abort();
			// 	ajax = 'none';
			// }
			// ajax = $.ajax({
       //      url: "/ajax/specialty",
			// 	status: $('.nPreloader').css('display', 'flex'),
			// 	data: {
       //          _token:CSRF_TOKEN,
       //          specialty_id:specialty_id,
       //          degree_id:degree_id,
       //          subdirection_id:subdirection_id,
       //          state_id:state_id,
       //          city_id:city_id,
       //          subject_id:subject_id,
       //          type_id:type_id,
       //          form_education_id:form_education_id,
       //          sort:sort,
       //          program_id:program_id,
			// 					un_id:un,
			// 		direction:direction_id,
			// 		search:search
			// 			}
       //  }).done(function(data){
       //      $('.result').html(data);
			// 	$('.nPreloader').css('display', 'none');
       //  })
    });

    $('.type').on('change', function() {
       //  var degree_id = $('#degree_id').val();
       //  var subdirection_id = $('#subdirection_id').val();
       //  var state_id = $('#state_id').val();
       //  var city_id = $('#city_id').val();
       //  var subject_id = [];
       //  $("input[name='subject_id']:checked").each(function (i) {
       //      subject_id[i] = $(this).val();
       //  });
       //  var type_id = this.value;
       //  var form_education_id = $('#form_education_id').val();
       //  var sort = $('#sortorder').val();
       //  var program_id = $('#program_id').val();
			// var direction_id = $('#direction_id').val();
			// var search = $('#rsearch').val();
      //
			// var un = $('#un_id').val();
      //
			// if (ajax != 'none') {
			// 	ajax.abort();
			// 	ajax = 'none';
			// }
			// ajax = $.ajax({
       //      url: "/ajax/specialty",
			// 			status: $('.nPreloader').css('display', 'flex'),
			// 			data: {
       //          _token:CSRF_TOKEN,
       //          degree_id:degree_id,
       //          subdirection_id:subdirection_id,
       //          state_id:state_id,
       //          city_id:city_id,
       //          subject_id:subject_id,
       //          type_id:type_id,
       //          form_education_id:form_education_id,
       //          sort:sort,
       //          program_id:program_id,
			// 					un_id:un,
			// 				direction:direction_id,
			// 				search:search
			// 			}
       //  }).done(function(data){
       //      $('.result').html(data);
			// 	$('.nPreloader').css('display', 'none');
       //  })
      SearchAjax('type_id', $(this).val());
    });
    $('.program').on('change', function() {
        var degree_id = $('#degree_id').val();
        var subdirection_id = $('#subdirection_id').val();
        var state_id = $('#state_id').val();
        var city_id = $('#city_id').val();
        var subject_id = [];
        $("input[name='subject_id']:checked").each(function (i) {
            subject_id[i] = $(this).val();
        });
        var type_id = $('#type_id').val();
        var form_education_id = $('#form_education_id').val();
        var sort = $('#sortorder').val();
        var program_id = this.value;
			var direction_id = $('#direction_id').val();

			var un = $('#un_id').val();
			var search = $('#rsearch').val();

			if (ajax != 'none') {
				ajax.abort();
				ajax = 'none';
			}
			ajax = $.ajax({
            url: "/ajax/specialty",
						status: $('.nPreloader').css('display', 'flex'),
						data: {
                _token:CSRF_TOKEN,
                degree_id:degree_id,
                subdirection_id:subdirection_id,
                state_id:state_id,
                city_id:city_id,
                subject_id:subject_id,
                type_id:type_id,
                form_education_id:form_education_id,
                sort:sort,
                program_id:program_id,
								un_id:un,
							direction:direction_id,
							search:search
						}
        }).done(function(data){
            $('.result').html(data);
				$('.nPreloader').css('display', 'none');
        })
    });

    $('.form_education').on('change', function() {
        var degree_id = $('#degree_id').val();
        var subdirection_id = $('#subdirection_id').val();
        var state_id = $('#state_id').val();
        var city_id = $('#city_id').val();
        var subject_id = [];
        $("input[name='subject_id']:checked").each(function (i) {
            subject_id[i] = $(this).val();
        });
        var type_id = $('#type_id').val();
        var form_education_id = this.value;
        var sort = $('#sortorder').val();
        var program_id = $('#program_id').val();
			var direction_id = $('#direction_id').val();
			var search = $('#rsearch').val();

			var un = $('#un_id').val();
			if (ajax != 'none') {
				ajax.abort();
				ajax = 'none';
			}
			ajax = $.ajax({
            url: "/ajax/specialty",
						status: $('.nPreloader').css('display', 'flex'),
						data: {
                _token:CSRF_TOKEN,
                degree_id:degree_id,
                subdirection_id:subdirection_id,
                state_id:state_id,
                city_id:city_id,
                subject_id:subject_id,
                type_id:type_id,
                form_education_id:form_education_id,
                sort:sort,
                program_id:program_id,
								un_id:un,
							direction:direction_id,
							search:search
						}
        }).done(function(data){
            $('.result').html(data);
				$('.nPreloader').css('display', 'none');
        })
    });

		$('.un').on('change', function() {
			// var degree_id = $('#degree_id').val();
			// var subdirection_id = $('#subdirection_id').val();
			// var state_id = $('#state_id').val();
			// var city_id = $('#city_id').val();
			// var subject_id = [];
			// $("input[name='subject_id']:checked").each(function (i) {
			// 	subject_id[i] = $(this).val();
			// });
			// var type_id = $('#type_id').val();
			// var form_education_id = $('#form_education_id').val();
			// var sort = $('#sortorder').val();
			// var program_id = $('#program_id').val();
			// var direction_id = $('#direction_id').val();
			// var search = $('#rsearch').val();

			var un = this.value;
      SearchAjax('un_id', un);

			// if (ajax != 'none') {
			// 	ajax.abort();
			// 	ajax = 'none';
			// }
			// ajax = $.ajax({
			// 	url: "/ajax/specialty",
			// 	status: $('.nPreloader').css('display', 'flex'),
			// 	data: {
			// 		_token:CSRF_TOKEN,
			// 		degree_id:degree_id,
			// 		subdirection_id:subdirection_id,
			// 		state_id:state_id,
			// 		city_id:city_id,
			// 		subject_id:subject_id,
			// 		type_id:type_id,
			// 		form_education_id:form_education_id,
			// 		sort:sort,
			// 		program_id:program_id,
			// 		un_id:un,
			// 		direction:direction_id,
			// 		search:search
			// 	}
			// }).done(function(data){
       //  $('.result').html(data);
			// 	$('.nPreloader').css('display', 'none');
			// })
		});

	$('.subject').on('click', function() {
			if($("input[name='subject_id']:checked").length <= 2) {
					$('.subject').on('change', function() {
              // if (CheckUrl('pr1') == 'any') {
              //   ChangeUrl('pr1', $(this).val());
              // } else {
              //   ChangeUrl('pr2', $(this).val());
              // }

              console.log($(this).val());
							var degree_id = $('#degree_id').val();
							var subdirection_id = $('#subdirection_id').val();
							var state_id = $('#state_id').val();
							var city_id = $('#city_id').val();
							var subject_id = [];
            var c = 0;

            $("input[name='subject_id']:checked").each(function (i) {
                  if (i === 0) {
                    ChangeUrl('pr1', $(this).val());
                  } else {
                    ChangeUrl('pr2', $(this).val());
                  }
									subject_id[i] = $(this).val();
									c = c + 1;
							});
							setTimeout(function () {
                if (c == 1) {
                  ChangeUrl('pr2', 'any');
                } else if (c == 0) {
                  ChangeUrl('pr1', 'any');
                  ChangeUrl('pr2', 'any');
                }
              }, 100);
							var type_id = $('#type_id').val();
							var form_education_id = $('#form_education_id').val();
							var sort = $('#sortorder').val();
							var program_id = $('#program_id').val();
						var direction_id = $('#direction_id').val();
						var search = $('#rsearch').val();

						if (ajax != 'none') {
							ajax.abort();
							ajax = 'none';
						}
						ajax = $.ajax({
									url: "/ajax/specialty",
									status: $('.nPreloader').css('display', 'flex'),
									data: {
											_token: CSRF_TOKEN,
											degree_id: degree_id,
											subdirection_id: subdirection_id,
											state_id: state_id,
											city_id: city_id,
											subject_id: subject_id,
											type_id: type_id,
											form_education_id: form_education_id,
											sort: sort,
											program_id:program_id,
										direction:direction_id,
										search:search
									}
							}).done(function (data) {
									$('.result').html(data);
									$('.nPreloader').css('display', 'none');
						})
					});
			}
			else{
					$(this).prop('checked', false);
					$('#erF').css('display', 'flex');
			}
	});
	$('#erF').on('click', function () {
		$(this).css('display', 'none');
	});

	$('.py-4').on('change', '.sgs-sort', function() { console.log(1);
			ChangeUrl('page', '1');
			var degree_id = $('#degree_id').val();
			var subdirection_id = $('#subdirection_id').val();
			var state_id = $('#state_id').val();
			var city_id = $('#city_id').val();
			var subject_id = [];
			$("input[name='subject_id']:checked").each(function (i) {
					subject_id[i] = $(this).val();
			});
			var type_id = $('#type_id').val();
			var form_education_id = $('#form_education_id').val();
			var sort = this.value;
			var program_id = $('#program_id').val();
		var direction_id = $('#direction_id').val();
		var search = $('#rsearch').val();

		if (ajax != 'none') {
			ajax.abort();
			ajax = 'none';
		}
		ajax = $.ajax({
					url: "/ajax/specialty",
					status: $('.nPreloader').css('display', 'flex'),
					data: {
							_token:CSRF_TOKEN,
							degree_id:degree_id,
							subdirection_id:subdirection_id,
							state_id:state_id,
							city_id:city_id,
							subject_id:subject_id,
							type_id:type_id,
							form_education_id:form_education_id,
							sort:sort,
							program_id:program_id,
						direction_id:direction_id,
						search:search
					}
			}).done(function(data){
					$('.result').html(data);
					$('.nPreloader').css('display', 'none');
			})
	});

	$(document).on('click','.ajax-pagination .pagination a', function(e){
			e.preventDefault();
			var degree_id = $('#degree_id').val();
			var subdirection_id = $('#subdirection_id').val();
			var search = $('#rsearch').val();
		var state_id = $('#state_id').val();

		var city_id = $('#city_id').val();
		var un_id = $('#un_id').val();
		var subject_id = [];
			$("input[name='subject_id']:checked").each(function (i) {
					subject_id[i] = $(this).val();
			});
			var type_id = $('#type_id').val();
			var form_education_id = $('#form_education_id').val();
			var page = $(this).attr('href').split('page=')[1];
			var sort = $('#sortorder').val();
			var program_id = $('#program_id').val();
		var direction_id = $('#direction_id').val();

		if (ajax != 'none') {
			ajax.abort();
			ajax = 'none';
		}
		ajax = $.ajax({
					url: "/ajax/specialty?page="+page,
					status: $('.nPreloader').css('display', 'flex'),
					data: {
							_token:CSRF_TOKEN,
							degree_id:degree_id,
							subdirection_id:subdirection_id,
							state_id:state_id,
							city_id:city_id,
							subject_id:subject_id,
							type_id:type_id,
							form_education_id:form_education_id,
							sort:sort,
							un_id:un_id,
							program_id:program_id,
						direction_id:direction_id,
						search:search
					}
			}).done(function(data){
				$('.result').html(data);
				$('.nPreloader').css('display', 'none');
				ChangeUrl('page', page);
		})
	});

	$(".collapse").on('show.bs.collapse', function(){
			$(this).parent().find('.fas').removeClass('fa-angle-down');
			$(this).parent().find('.fas').addClass('fa-angle-up');
	});
	$(".collapse").on('hide.bs.collapse', function(){
			$(this).parent().find('.fas').addClass('fa-angle-down');
			$(this).parent().find('.fas').removeClass('fa-angle-up');
	});

	/*Slick*/
	$('.slick-slider').slick({
			dots: false,
			infinite: true,
			speed: 500,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 2000,
			arrows: true,
			responsive: [{
					breakpoint: 600,
					settings: {
						arrows: true,
							slidesToShow: 2,
							slidesToScroll: 1
					}
			},
					{
						arrows: true,
							breakpoint: 400,
							settings: {
									slidesToShow: 1,
									slidesToScroll: 1
							}
					}]
	});

	$(window).scroll(function(){ //кнопка наверх
			if ($(window).scrollTop() >= 100 ){
					$('#bottom').css('display', 'block');
			} else {
					$('#bottom').css('display', 'none');
			}
	});

	function UpdateS() {
		$('.degree').chosen('destroy');
		$('.degree').chosen();
		$('.direction').chosen('destroy');
		$('.direction').chosen();
		$('.subdirection').chosen('destroy');
		$('.subdirection').chosen();
		$('.specialty').chosen('destroy');
		$('.specialty').chosen();
		$('.city').chosen('destroy');
		$('.city').chosen();
		$('.un').chosen('destroy');
		$('.un').chosen();
		$('.program').chosen('destroy');
		$('.program').chosen();
		$('.type').chosen('destroy');
		$('.type').chosen();
	}
});
$(document).ready(function () {
	$('#dropdown').on('show.bs.dropdown', function () {
		$('#dropdown1').toggleClass('selected');
	});
	$('#dropdown').on('hide.bs.dropdown', function () {
		$('#dropdown1').toggleClass('selected');
	});
});
$(document).ready(function() {
	$('.phone_mask').mask('+7 000 000 00 00');
	$('.soc-icon-clicked').click(function() {
		$('.slideList-menu').slideUp(400, function() {
			$('.slideList-soc-icon').slideToggle();
		})
	});
	$('.rating-clicked').click(function() {
		$('.sub-navigator-slide').slideUp(400, function() {
			$('.sub-slideList').slideToggle();
		});
	});
	$('.nav-clicked').click(function() {
		$('.sub-slideList').slideUp(400, function() {
			$('.sub-navigator-slide').slideToggle();
		});
	});
	$('.icon-menu-clicked').click(function() {
		$('.slideList-soc-icon').slideUp(400, function() {
			$('.slideList-menu').slideToggle();
		})
	});

	$('#login-form-close').click(function () {
		$('#form').hide();
	});

	$('.div-with-table table').wrap('<div></div>');
});
function ChangeUrl (param, value) {
	var url = new URL(window.location);
	var query_string = url.search;
	var search_params = new URLSearchParams(query_string);
	search_params.set(param, value);
	url.search = search_params.toString();
	var new_url = url.toString();
	console.log(new_url);
	window.history.pushState('page2', 'Title', new_url);
}
function CheckUrl (param) {
  var url = new URL(window.location);
  var urlParams = new URLSearchParams(window.location.search);
  var ch = urlParams.get(param);
  return ch;
}
(function($) {
	$('ul.pagination li.active')
		.prev().addClass('show-mobile')
		.prev().addClass('show-mobile');
	$('ul.pagination li.active')
		.next().addClass('show-mobile')
		.next().addClass('show-mobile');
	$('ul.pagination')
		.find('li:first-child, li:last-child, li.active')
		.addClass('show-mobile');
})(jQuery);
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("logged");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
};
setTimeout(fade_out, 6000);
function fade_out() {
	$("#messagError").fadeOut().empty();
}
