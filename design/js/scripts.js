/*
 * Nucleus Multi-Purpose Technology Template
 * Copyright 2016 8Guild.com
 * Theme Custom Scripts
 */
 /* ╔══╗╔═══╗╔╗╔╗╔══╗╔╗──╔══╗
  	║╔╗║║╔══╝║║║║╚╗╔╝║║──║╔╗╚╗
  	║╚╝║║║╔═╗║║║║─║║─║║──║║╚╗║
  	║╔╗║║║╚╗║║║║║─║║─║║──║║─║║
  	║╚╝║║╚═╝║║╚╝║╔╝╚╗║╚═╗║╚═╝║
  	╚══╝╚═══╝╚══╝╚══╝╚══╝╚═══╝
*/

jQuery(document).ready(function($) {
	'use strict';
	//метод анализа иерархий
	var max = 12; //максимальное число критериев или альтернатив
	var amount_criterians = 2; //количетсво критериев 	
	var amount_alternatives = 2; //количество альтернатив 
	var criterians_val = []; // строковые значения критериев
	var altenatives_val = []; // строковые значения альтернатив
	var fraction = ['1/2', '1/3', '1/4', '1/5', '1/6', '1/7', '1/8', '1/9']; //массив дробных значений для матрицы сравнений
	var integers = ['2', '3', '4', '5', '6', '7', '8', '9']; //массив целых значений для матрицы сравнений
	var n = [0,0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59] //величина случайной согласованности
    var third_step_index = 0; //номер шага на втором этапе;
	var coherence_list = ['Dim', 'Lam', 'CI', 'CR']; // список критериев для согласованности
	var weights_purpose = []; // веса для цели
	var weights_alt = [] //веса альтернатив
	
	//добавляем критерий
	$('#plus-criterian').on('click', function(){
		if(amount_criterians < max){
			amount_criterians++;
			$('#tbody-criterians').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">'+ amount_criterians +'</th>' +
					'<td class="td-no-padding"><input name="criterian_'+ (amount_criterians - 1) +'" required placeholder="Критерий'+ amount_criterians +'" class="form-control input-no-margin" placeholder="Критерий '+ amount_criterians +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-criterians').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество критериев');
		}
	});
    //добавляем альтернативу
	$('#plus-alternative').on('click', function(){
		if(amount_alternatives < max){
			amount_alternatives++;
			$('#tbody-alternatives').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">'+ amount_alternatives +'</th>' +
					'<td class="td-no-padding"><input name="alternative_'+ (amount_alternatives - 1) +'" required placeholder="Альтернатива'+ amount_alternatives +'" class="form-control input-no-margin" placeholder="Альтернатива '+ amount_alternatives +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-alternatives').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество альтернатив');
		}
	});
	//удаляем критерий
	$('#minus-criterian').on('click', function(){
		if(amount_criterians != 2){
			amount_criterians--;
			$('#tbody-criterians').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	//удаляем альтернативу
	$('#minus-alternative').on('click', function(){
		
		if(amount_alternatives != 2){
			amount_alternatives--;
			$('#tbody-alternatives').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	//строим матрицу сравнений для критериев
	
	$('body').on('click', '#build-comparisons', function(){
		
		if($('#purpose_area').val() != '' )
		{
			var flag = true;
			var criterians = $('#tbody-criterians > tr');
			var altenatives = $('#tbody-alternatives > tr');
			
			for(var i = 0; i < amount_criterians; i++){
				var value = criterians.eq(i).find('td').find('input').val();
				
				if(value != ''){
					criterians_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			//заполняем массив со значениями альтернатив
			for(var i = 0; i < amount_alternatives; i++){
				var value = altenatives.eq(i).find('td').find('input').val();
				//если найдена пустая альтернатива то выдать ошибку
				if(value != ''){
					altenatives_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			
			if(flag)
			{
				//строим матрицу парных сравнений
				var data = '\
				<div style="display:none">\
					<h3 class="block-title block-title-no-margin text-center">Шаг 2</h3>\
					<h5 class="block-title text-center">Заполните матрицу парных сравнений Критериев относительно цели:</h5>\
					<div class="row">\
					  <div class="col-lg-9 col-md-9 col-sm-9">\
						<div class="table-responsive space-bottom-1x">\
						   <table class="table-responsive" id="table-criterians-vs-criterians">\
							<thead>\
								<tr>\
								<th>#</th>\
				';
				for(var i = 0; i < amount_criterians; i++){
					data += '<th>' + criterians_val[i] + '</th>';
				}
				
				data += 		'</tr>\
							</thead>\
							<tbody>';
				
				for(var i = 0; i < amount_criterians; i++){
					data += '<tr>'
					data += '<th scope="row">'+ criterians_val[i] +'</th>';
					
					for(var j = 0; j < amount_criterians; j++){
						if(i == j){
							data += '<td class="td-no-padding"><input value="1" id="comparisons_cr_vs_cr_'+ i +'_'+ j +'" readonly required class="form-control input-no-margin text-center"></input></td>';
						}
						else{
							data += '<td class="td-no-padding"><input value="1" id="comparisons_cr_vs_cr_'+ i +'_'+ j +'" required class="form-control input-no-margin compr-cr-vs-cr text-center"></input></td>';
						}
					}
					data += '</tr>';
				}
				
				data +=     '</tbody>\
							</table>\
						  </div>\
						</div>';
				//строим матрицу весов 
				data +=	'<div class="col-lg-3 col-md-3 col-sm-3">\
						  <table class="table-responsive" id="table-weights-for-purpose">\
							<thead>\
								<tr>\
									<th>#</th>\
									<th>Вес</th>\
								</tr>\
							</thead>\
							<tbody>';
							
				for(var i = 0; i < amount_criterians; i++){
					data += '<tr>'
					data += '<th scope="row">'+ criterians_val[i] +'</th>';
					data += '<td class="td-no-padding"><input required readonly class="form-control input-no-margin"></input></td>';
					data += '</tr>';
				}
				
				data +=     '</tbody>\
							</table>\
					 </div>\
					 </div>';
					 
				//строим таблицу согласованности
				data += '<div class="row">'
				data += '<div class="col-lg-9 col-md-9 col-sm-9">\
						  <table class="table-responsive" id="coherence-purpose">\
							<thead>\
								<tr>';
				for(var i = 0; i < coherence_list.length; i++){
					data += '<th>' + coherence_list[i] + '</th>';
				}

				data +=		   ' </tr>\
							</thead>\
							<tbody>';
				data += '<tr>'
				
				for(var i = 0; i < coherence_list.length; i++){
					data += '<td class="td-no-padding"><input required readonly class="form-control input-no-margin text-center"></input></td>';
				}
				
				data += '</tr>';
				data +=     '</tbody>\
							</table>\
						</div>';
				data += '<div class="col-lg-3 col-md-3 col-sm-3">\
							 <button type="button" id="next-step" class="btn btn-no-margin-top btn-block btn-ghost btn-default waves-effect waves-light">Далее</button>\
						</div>';
					 
				data +=	'</div>\
						</div>';
				
				$(data).appendTo('.second-step').show('slow');
				$('body').find('#build-comparisons').attr('id', 'build-comparisons-used');
			}
			else{
				alert('Заполните все поля');
			}
		}
		else{
			alert("Введите цель");
		}
	});
	
	$('body').on('keyup', '.compr-cr-vs-cr', function(){
		var input = $(this);
		for(var i = 0; i < fraction.length; i++){
			//если ввели дробное число заполнить зеркальную клетку целым числом
			if(input.val() == fraction[i]){
				var indexes = getIndexesMatrix(this.id);//получаем индексы этой клетки 
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).val(Math.pow(eval(input.val()),-1)); //заполняем зеркальную клетку целым числом
				calculateWeights($('#table-weights-for-purpose'), '#comparisons_cr_vs_cr_', $('#coherence-purpose'), true);
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300); //анимируем зеркальную клетку
				break;
			}
			//если ввели целое
			if(input.val() == integers[i]){
				var indexes = getIndexesMatrix(this.id);
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).val(fraction[i]);
				calculateWeights($('#table-weights-for-purpose'), '#comparisons_cr_vs_cr_', $('#coherence-purpose'), true);
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300);
				break;
			}
			//если ввели 1
			if(input.val() == 1){
				var indexes = getIndexesMatrix(this.id);
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).val(1);
				calculateWeights($('#table-weights-for-purpose'), '#comparisons_cr_vs_cr_', $('#coherence-purpose'), true);
				$('#comparisons_cr_vs_cr_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300);
				break;
			}
		}
		
	});
	//расчитываем веса для матриц сравнения
	function calculateWeights(weightsTable, comparisonsIdMatr, coherenceTable, attr){
		var N;
		if(attr){
			N = amount_criterians;
		}
		else{
			N = amount_alternatives;
		}
		var compr = new Array();//значение матрицы сравнеий 
		var weight = new Array(); //значение весов
		var rationing = 0; //переменная для нормировки на единицу
		var coherence = new Array();
			
		for(var i = 0; i < N; i++){
			compr[i] = new Array();
			for(var j = 0; j < N; j++){
				compr[i][j] = eval($(comparisonsIdMatr + i + '_' + j).val());
			}
		}

		//расчитываем веса
		for(var i = 0; i < N; i++){
			var res = 1;
			for(var j = 0; j < N; j++){
				res *= compr[i][j];
			}
				
			weight[i] = Math.pow(res, 1/N);
			rationing += weight[i];
		}
			
		for(var i = 0; i < N; i++){
				weight[i] /= rationing;
		}
			
		coherence[0] = N; //Dim
		coherence[1] = 0;
			
		//расчитываем Lmax
		for(var i = 0; i < N; i++){
			var summ = 0;
			for(var j = 0; j < N; j++){
				summ +=  compr[j][i];
			}
			coherence[1] += summ * weight[i];
		}
			
		coherence[2] =  (coherence[1] - N)/(N - 1); //CI
		if(N > 2){
			coherence[3] = coherence[2]/n[N - 1]; //OC
		}
		
		for(var i = 0; i < coherence.length; i++){
			$(coherenceTable).find('input').eq(i).val(coherence[i].toFixed(4).toString());
		}
			
		for(var i = 0; i < N; i++){
			$(weightsTable).find('input').eq(i).val(weight[i].toFixed(4).toString());
		}
		
	}
	//получаем индекс любого id в каком либо input
	function getIndexesMatrix(str){
		var indexes = {};
		indexes.i = str.substr(str.length-3,1); //i-ое
		indexes.j = str.substr(str.length-1,1); //j-ое
		return indexes;
	}
	
	//при клике в матрицу сравнений на третьем шаге
	$('body').on('click', '#next-step', function(){
		var flag = true;
		if(third_step_index <= amount_criterians - 1){
			
			//если этап в 3 шаге не первый то
			if(third_step_index > 0)
			{
				//заполняем матрицу весов альтернатив относительно критериев
				var input = $('#table-weights-for-alternatives').find('input');
				//создаем строку в матрице
				weights_alt[third_step_index - 1] = new Array();
				for(var i = 0; i < amount_alternatives; i++){
					if(input.eq(i).val() == ''){
						flag = false;
						weights_alt[third_step_index - 1] = [];
						alert('Заполните матрицу весов');
						break; //если input пустой прервать цикл и вывести alert, и обнулить массив
					}
					else{
						weights_alt[third_step_index - 1].push(input.eq(i).val());
					}
				}
				if(flag){
					//меняем сначала id у матрицы сравнений,
					//чтобы мы больше не могли к ней обратиться
					for(var i = 0; i < amount_alternatives; i++){
						for(var j = 0; j < amount_alternatives; j++){
							$('#comparisons_alt_vs_alt_' + i + '_' + j).attr('readonly', true);
							$('#comparisons_alt_vs_alt_' + i + '_' + j).attr('id', 'comparisons_alt_vs_alt_' + i + '_' + j + '_used');
						}
					}
					//затем id у таблицы весов и таблицы альтернатив
					$('#table-weights-for-alternatives').attr('id', 'table-weights-for-alternatives_used');
					$('#coherence-alternatives').attr('id', 'coherence-alternatives_used');
				}
			}
			//если первый то считываем веса, которые получились у нас для цели в массив
			else{
				var input = $('#table-weights-for-purpose').find('input');
				for(var i = 0; i < amount_criterians; i++){
					if(input.eq(i).val() == ''){
						flag = false;
						weights_purpose = [];
						alert('Заполните матрицу весов');
						break;
					}
					else{
						weights_purpose.push(input.eq(i).val());
					}
				}
				if(flag){
					for(var i = 0; i < amount_criterians; i++){
						for(var j = 0; j < amount_criterians; j++){
							$('#comparisons_cr_vs_cr_' + i + '_' + j).attr('readonly', true);
						}
					}
				}
			}
			
			if(flag){
				// меняем значение id на другое чтобы эта кнопка больше не срабатывала
				 $(this).attr('id', 'used-next-step');
				 var data = '\
					 <div style="display:none">';
				 //строим матрицу парных сравнений
				 if(third_step_index == 0){ 
				 data +=   '<h3 class="block-title block-title-no-margin text-center">Шаг 3</h3>\
							<h5 class="block-title text-center">Сравните альтернативы попарно по отношению к каждому критерию</h5>' 
							}
				 data +=   '<p class="text-center"><span style="font-weight: bold">2.'+ (third_step_index+1) +'</span> По отношению к критерию <span style="font-weight: bold"> '+ criterians_val[third_step_index] +'</span>:\
							<div class="row">\
							  <div class="col-lg-9 col-md-9 col-sm-9">\
								<div class="table-responsive space-bottom-1x">\
								   <table class="table-responsive" id="table-alternatives-vs-alternatives">\
									<thead>\
										<tr>\
										<th>#</th>\
						';
					for(var i = 0; i < amount_alternatives; i++){
						data += '<th>' + altenatives_val[i] + '</th>';
					}
					
					data += 		'</tr>\
								</thead>\
								<tbody>';
								
					for(var i = 0; i < amount_alternatives; i++){
						data += '<tr>'
						data += '<th scope="row">'+ altenatives_val[i] +'</th>';
						
						for(var j = 0; j < amount_alternatives; j++){
							if(i == j){
								data += '<td class="td-no-padding"><input value="1" id="comparisons_alt_vs_alt_'+ i +'_'+ j +'" readonly required class="form-control input-no-margin text-center"></input></td>';
							}
							else{
								data += '<td class="td-no-padding"><input value="1" id="comparisons_alt_vs_alt_'+ i +'_'+ j +'" required class="form-control input-no-margin compr-alt-vs-alt text-center"></input></td>';
							}
						}
						data += '</tr>';
					}
					
					data +=     '</tbody>\
							</table>\
						  </div>\
						</div>';
				//строим матрицу весов 
				data +=	'<div class="col-lg-3 col-md-3 col-sm-3">\
					  <table class="table-responsive" id="table-weights-for-alternatives">\
						<thead>\
							<tr>\
								<th>#</th>\
								<th>Вес</th>\
							</tr>\
						</thead>\
						<tbody>';
				
				for(var i = 0; i < amount_alternatives; i++){
					data += '<tr>'
					data += '<th scope="row">'+ altenatives_val[i] +'</th>';
					data += '<td class="td-no-padding"><input required readonly class="form-control input-no-margin"></input></td>';
					data += '</tr>';
				}
				
				data +=     '</tbody>\
						</table>\
					</div>\
				 </div>';
				 
				 //строим таблицу согласованности
				data += '<div class="row">'
				data += '<div class="col-lg-9 col-md-9 col-sm-9">\
						  <table class="table-responsive" id="coherence-alternatives">\
							<thead>\
								<tr>';
				for(var i = 0; i < coherence_list.length; i++){
					data += '<th>' + coherence_list[i] + '</th>';
				}

				data +=		   ' </tr>\
							</thead>\
							<tbody>';
				data += '<tr>';
				for(var i = 0; i < coherence_list.length; i++){
					data += '<td class="td-no-padding"><input required readonly class="form-control input-no-margin text-center"></input></td>';
				}
				
				data += '</tr>';
				data +=     '</tbody>\
							</table>\
						</div>';
				if(third_step_index != amount_criterians - 1)
				{
					data += '<div class="col-lg-3 col-md-3 col-sm-3">\
						 <button type="button" id="next-step" class="btn btn-no-margin-top btn-block btn-ghost btn-default waves-effect waves-light">Далее</button>\
					</div>';
				}
				else{
					data += '<div class="col-lg-3 col-md-3 col-sm-3">\
						 <button type="button" id="solve" class="btn btn-no-margin-top btn-block btn-primary waves-effect waves-light">Решить</button>\
					</div>';
				}		
				
				data +=	'</div>\
					</div>';
				
				third_step_index++;
				$(data).appendTo('.third-step').show('slow');
			}
		}
	});
	
	$('body').on('keyup', '.compr-alt-vs-alt', function(){
		var input = $(this);
		for(var i = 0; i < fraction.length; i++){
			//если ввели дробное число заполнить зеркальную клетку целым числом
			if(input.val() == fraction[i]){
				var indexes = getIndexesMatrix(this.id);//получаем индексы этой клетки 
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).val(Math.pow(eval(input.val()),-1)); //заполняем зеркальную клетку целым числом
				calculateWeights($('#table-weights-for-alternatives'), '#comparisons_alt_vs_alt_', $('#coherence-alternatives'), false);
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300); //анимируем зеркальную клетку
				break;
			}
			//если ввели целое
			if(input.val() == integers[i]){
				var indexes = getIndexesMatrix(this.id);//получаем индексы этой клетки 
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).val(fraction[i]); //заполняем зеркальную клетку целым числом
				calculateWeights($('#table-weights-for-alternatives'), '#comparisons_alt_vs_alt_', $('#coherence-alternatives'), false);
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300); //анимируем зеркальную клетку
				break;
			}
			//если ввели 1
			if(input.val() == 1){
				var indexes = getIndexesMatrix(this.id);//получаем индексы этой клетки 
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).val(1); //заполняем зеркальную клетку целым числом
				calculateWeights($('#table-weights-for-alternatives'), '#comparisons_alt_vs_alt_', $('#coherence-alternatives'), false);
				$('#comparisons_alt_vs_alt_' + indexes.j + '_' + indexes.i).animate({ backgroundColor: "#1bdb68" },100).delay(300).animate({ backgroundColor: "#fff" }, 300); //анимируем зеркальную клетку
				break;
			}
		}
	});
	
	//при клике на кнопку решить
	$('body').on('click', '#solve', function(){
		
		var flag = true;
		
		var input = $('#table-weights-for-alternatives').find('input');
		
		//создаем строку в матрице
		weights_alt[third_step_index - 1] = new Array();
		
		for(var i = 0; i < amount_alternatives; i++){
			if(input.eq(i).val() == ''){
				flag = false;
				weights_alt[third_step_index - 1] = [];
				alert('Заполните матрицу весов');
				break; //если input пустой прервать цикл и вывести alert, и обнулить массив
			}
		else{
			weights_alt[third_step_index - 1].push(input.eq(i).val());
			}
		}
		if(flag){
			$(this).attr('id', 'used-solve');
	
			var total = result(weights_purpose, weights_alt); //расчитываем итоговые веса
			
			var data = '\
			<div style="display:none">\
				<h3 class="block-title block-title-no-margin text-center">Результат <small><span class="text-default"></span>Цель: '+ $('#purpose_area').val() +'</small></h3><br><br>\
				<div class="row">\
				  <div class="col-lg-4 col-md-6 col-sm-10">\
					<div class="table-responsive space-bottom-1x">\
					   <table class="table-responsive" id="table-result">\
						<thead>\
							<tr>\
							<th>#</th>\
							<th>Альтернативы</th>\
							<th>Вес</th>\
			';
			
			data += 		'</tr>\
						</thead>\
						<tbody>';
			
			for(var i = 0; i < amount_alternatives; i++){
				data += '<tr>'
				data += '<th scope="row">'+ (i + 1) +'</th>';
				data += '<td class="td-no-padding"><input value="'+ altenatives_val[i] +'" id="result_'+ i +'" readonly required class="form-control input-no-margin"></input></td>';
			    data += '<td class="td-no-padding"><input name="result_weights_'+ i +'" value="'+ total[i].toFixed(3).toString() +'" id="result_weights_'+ i +'" readonly required class="form-control input-no-margin text-center"></input></td>';
				data += '</tr>';
			}
			
			data +=     '</tbody>\
						</table>\
					  </div>\
					</div>';
					
			data += '<div class="col-lg-8 col-md-6 col-sm-12">\
						<div id="chartdiv" style="width: 100%; height: 300px;">\
						</div>\
					</div>\
				</div>';

			var msg = "getCookie=0";
			var isRegistered = false;
			$.ajax({
              type: 'POST',
              url: 'handler.php',
              data: msg,
              success: function(data) {
                if(data != ''){
                	isRegistered = true;
                }
              },
              error:  function(xhr, str){
              console.log('Возникла ошибка: ' + xhr.responseCode);
              },
              async: false
          	});
			
          	if(isRegistered == true){
				data += '<div class="row">\
							<div class="col-lg-12 col-md-12 col-sm-12">\
								<button type="button" style="width: 100%;" id="save" class="btn btn-ghost btn-primary waves-effect waves-light">Сохранить и перейти в личный кабинет</button>\
						    </div>\
						</div>\
				</div>';
				
			}
			else{
				data += '<div class="row">\
							<div class="col-lg-12 col-md-12 col-sm-12">\
								<button type="submit" name="save" style="width: 100%;" class="btn btn-ghost btn-primary waves-effect waves-light">Провести новое испытание</button>\
						    </div>\
						</div>\
				</div>';
			}
			var associative_arr = [];
			
			for(var i = 0; i < amount_alternatives; i++){
				associative_arr[i] = {};
				associative_arr[i].altName = altenatives_val[i];
				associative_arr[i].value = total[i].toFixed(3);
			}
			
			$(data).appendTo('.last-step').show('slow');
			
			var chart = AmCharts.makeChart( "chartdiv", {
			  "type": "pie",
			  "theme": "light",
			  "dataProvider": associative_arr,
			  "valueField": "value",
			  "titleField": "altName",
			  "outlineAlpha": 0.4,
			  "depth3D": 15,
			  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
			  "angle": 30,
			  "export": {
				"enabled": false
			  }
			} );
		}
	});
	
	$('body').on('click', '#save', function(){

		var msg = $('#mah').serialize();
		msg += "&amount_criterians=" + amount_criterians + "&amount_alternatives=" + amount_alternatives + "&methodType=mah" + "&getCookie=0";
		
		//отправляем файлу handler php данные, а также ожидаем от него куки с id пользователя
		$.ajax({
          type: 'POST',
          url: 'handler.php',
          data: msg,
          success: function(data) {
            $(location).attr('href',"account.php?user_id=" + data);
            //console.log(data);
          },
          error:  function(xhr, str){
	      	console.log('Возникла ошибка: ' + xhr.responseCode);
          }
        });
	});
	function result(weights_purpose, weights_alt){
		
	    var total_weights = [];
		var transpose_weights_alt = [];
		
		//транспонируем матрицу весов альтернатив
		
		var n = weights_alt.length; //количество строк матрицы
		var m = weights_alt[0].length; //количество столбоц матрицы
		
		for(var i = 0; i < m; i++){
			transpose_weights_alt[i] = new Array();
			for(var j = 0; j < n; j++){
				transpose_weights_alt[i][j] = weights_alt[j][i];
			}
		}
		//расчитываем итоговые вес
		for(var i = 0; i < transpose_weights_alt.length; i++){
			var summ = 0;
			for(var j = 0; j < transpose_weights_alt[i].length; j++){
				summ += transpose_weights_alt[i][j]*weights_purpose[j];
			}
			total_weights.push(summ);
		}
		return total_weights;
		
	}
	

	
	//метод матрицы решений
	//метод матрицы решений
	//метод матрицы решений
	
	var max = 12; //максимальное число критериев или альтернатив
	var amount_alternatives = 2; //количество альтернатив 
	var amount_conditions = 2; //количество альтернатив 
	var altenatives_val = []; // строковые значения альтернатив
	var conditions_val = []; // строковые значения критериев
	
	//добавляем альтернативу
	$('#plus-alternative-matrix-method').on('click', function(){
		if(amount_alternatives < max){
			amount_alternatives++;
			$('#tbody-alternatives-matrix-method').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">A'+ amount_alternatives +'</th>' +
					'<td class="td-no-padding"><input name="alternative_'+ (amount_alternatives - 1) +'" required placeholder="Альтернатива'+ amount_alternatives +'" class="form-control input-no-margin" placeholder="Алтернатива '+ amount_criterians +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-alternatives-matrix-method').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество критериев');
		}
	});
    //удаляем альтернативу
	$('#minus-alternative-matrix-method').on('click', function(){
		if(amount_alternatives != 2){
			amount_alternatives--;
			$('#tbody-alternatives-matrix-method').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	//добавляем условие
	$('#plus-condition-matrix-method').on('click', function(){
		if(amount_conditions < max){
			amount_conditions++;
			$('#tbody-conditions-matrix-method').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">B'+ amount_conditions +'</th>' +
					'<td class="td-no-padding"><input name="criterian_'+ (amount_conditions - 1) +'" required placeholder="Условие'+ amount_conditions +'" class="form-control input-no-margin" placeholder="Условие '+ amount_alternatives +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-conditions-matrix-method').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество альтернатив');
		}
	});
	//удаляем условие
	$('#minus-condition-matrix-method').on('click', function(){
		
		if(amount_conditions != 2){
			amount_conditions--;
			$('#tbody-conditions-matrix-method').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	
	
	$('body').on('click', '#build-matrix-method', function(){
		if($('#purpose_area_matrix_method').val() != '')
		{
			var flag = true;
			var altenatives = $('#tbody-alternatives-matrix-method > tr');
			var conditions = $('#tbody-conditions-matrix-method > tr');
			
			for(var i = 0; i < amount_alternatives; i++){
				var value = altenatives.eq(i).find('td').find('input').val();
				
				if(value != ''){
					altenatives_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			
			for(var i = 0; i < amount_conditions; i++){
				
				var value = conditions.eq(i).find('td').find('input').val();
				if(value != ''){
					conditions_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			if(flag)
			{
				//строим матрицу парных сравнений
				var data = '\
				<div style="display:none">\
					<h3 class="block-title block-title-no-margin text-center">Шаг 2</h3>\
					<h5 class="block-title text-center">Заполните матрицу полезности:</h5>\
					<div class="row">\
					  <div class="col-lg-12 col-md-12 col-sm-12">\
						<div class="table-responsive space-bottom-1x">\
						   <table class="table-responsive" id="utility-matrix">\
							<thead>\
								<tr>\
								<th>#</th>\
				';
				for(var i = 0; i < amount_conditions; i++){
					data += '<th>B'+ (i+1) +'</th>';
				}
				
				data += 		'</tr>\
							</thead>\
							<tbody>';
				
				
				for(var i = 0; i < amount_alternatives; i++){
					data += '<tr>'
					data += '<th scope="row">A'+ (i+1) +'</th>';
					
					for(var j = 0; j < amount_conditions; j++){
						
						data += '<td class="td-no-padding"><input name="utility_matrix_'+ i +'_'+ j +'" value="" id="utility_matrix_'+ i +'_'+ j +'" required class="form-control input-no-margin text-center"></input></td>';
						
					}
					data += '</tr>';
				}
				
				data +=     '</tbody>\
							</table>\
						  </div>\
						</div>';
				
				data += '<div class="row">'
				data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="button" id="choose-rools" class="btn btn-no-margin-top btn-block btn-ghost btn-default waves-effect waves-light">Выбрать правила ММР</button>\
						</div>';
				data +=	'</div>\
						</div>';
				
				$(data).appendTo('.second-step').show('slow');
				$('body').find('#build-matrix-method').attr('id', 'build-matrix-method-used');
			}
			else{
				alert('Заполните все поля');
			}
		}
		else{
			alert("Введите цель");
		}
	});
	
	
	$('body').on('click', '#choose-rools', function(){
		
		var flag = true;
		for(var i = 0; i < amount_alternatives; i++){	
			if(flag){
				for(var j = 0; j < amount_conditions; j++){
					if($('#utility_matrix_' + i + "_" + j).val() == ''){
						alert('Заполните матрицу полезности полностью');
						flag = false;
						break;
					}
				}
			}
		}
		
		if(flag){
			var data = '\
				<div style="display: none;">\
					<h3 class="block-title block-title-no-margin text-center">Шаг 3</h3>\
					<h5 class="block-title text-center">Выберите правила ММР:</h5>\
					<div class="row">\
					  <div class="col-lg-12 col-md-12 col-sm-12">\
						  <div class="form-group">\
							<label class="checkbox">\
							  <input type="checkbox" id="Laplas"> Найти оптимальный вариант по Лапласу\
							</label>\
							<label class="checkbox">\
							  <input type="checkbox" id="Vald"> Найти оптимальный вариант по Вальду\
							</label>\
							<label class="checkbox">\
							  <input type="checkbox" id="Sevidg"> Найти оптимальный вариант по Сэвиджу\
							</label>\
							<label class="checkbox">\
							  <input type="checkbox" id="Gurvich"> Найти оптимальный вариант по Гурвицу\
							</label>\
						  </div>\
					  </div>\
					</div>\
					<div class="row>\
						<div class="col-lg-12 col-md-12 col-sm-12">\
							<input class="form-control input-for-gurvich text-center" pattern="\d+(\.\d{2})?" id="alfa" placeholder="Введите альфа от 0 до 1 (0.5)">\
						</div>\
					</div>\
					<div class="row">\
						<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="button" id="solve-matrix-method" class="btn btn-no-margin-top btn-block btn-ghost btn-default waves-effect waves-light">Рассчитать</button>\
						</div>\
					</div>\
				</div>';
			$(data).appendTo('.third-step').show('slow', function() {
			});
			$('input').iCheck(); 
			$(this).attr('id', 'choose-rools-used');
		}
	});
	
	$('body').bind('.checkbox ifChecked', function(){
		
	});
	var clicker = false; // если false то мы еще не нажимали эту кнопку
	$('body').on('click', '#solve-matrix-method', function(){
		
		if(clicker){
			clicker = false;
			$('#result-matrix-method').hide('slow', function(){
				$('#result-matrix-method').remove();
			});
			
		}
		else{
			
			clicker = true;
			
			var listMethods = []; //список методов, которые выбрал пользователь
			var flag = true;
			//узнаем какими методами пользователь хочет решить задачу
			for(var i = 0; i < 4; i++){
				if(typeof $('body').find('.checkbox .checked').eq(i).find('input').attr('id') != "undefined"){
					listMethods.push($('body').find('.checkbox .checked').eq(i).find('input').attr('id'));
				}
			}

			//если не выбрано ни одно поле метода то выдать alert
			for(var i = 0; i < 4; i++){
				if(typeof $('body').find('.checkbox .checked').eq(i).find('input').attr('id') != "undefined"){
					flag = true;
					break;
				}
				else{
					flag = false;
				}
			}
			
			//проверяем допустил ли пользователь ошибку
			for(var i = 0; i < listMethods.length; i++){
				if(listMethods[i] == "Gurvich"){
					if($('#alfa').val() == ''){
						flag = false;
						break;
					}
				}
			}
			//если пользователь не допустил ошибок то выполняем методы
			if(flag){
				var utilityMatrix = [];
				
				for(var i = 0; i < amount_alternatives; i++){
					utilityMatrix[i] = new Array();
					for(var j = 0; j < amount_conditions; j++){
						utilityMatrix[i][j] = eval($('#utility_matrix_' + i + "_" + j).val());
					}
				}
				
				var data = '\
				<div id="result-matrix-method" style="display:none">\
					<div class="row">\
					  <div class="col-lg-12 col-md-12 col-sm-12">\
					  <h3 class="block-title block-title-no-margin text-center">Результат <small><span class="text-default"></span>Цель: '+ $('#purpose_area_matrix_method').val() +'</small></h3><br><br>\
						<div class="table-responsive space-bottom-1x">\
						   <table class="table-responsive" id="utility-matrix-decision">\
							<thead>\
								<tr>\
								<th>#</th>\
								<th>Расчет</th>\
								<th>Оптимальная альтернатива</th>\
				';
				
				data += 		'</tr>\
							</thead>\
							<tbody>';
				console.log(listMethods);
				for(var i = 0; i < listMethods.length; i++){
						
						if(listMethods[i] == 'Laplas'){
							data += '<tr>'
							data += '<th scope="row">'+ (i+1) +'</th>';
							data += '<td class="td-no-padding"><input required readonly name="Laplas" class="form-control input-no-margin text-center" value="По Лапласу"></input></td>';
							data += '<td class="td-no-padding"><input required readonly name="Laplas_value" id="Laplas" class="form-control input-no-margin text-center" value="'+ Laplas(utilityMatrix, altenatives_val) +'"></input></td>';
							data += '</tr>';
						}
						else if(listMethods[i] == 'Vald'){
							data += '<tr>'
							data += '<th scope="row">'+ (i+1) +'</th>';
							data += '<td class="td-no-padding"><input required readonly name="Vald" class="form-control input-no-margin text-center" value="По Вальду"></input></td>';
							data += '<td class="td-no-padding"><input required readonly name="Vald_value" id="Vald" class="form-control input-no-margin text-center" value="'+ Vald(utilityMatrix, altenatives_val) +'"></input></td>';
							data += '</tr>';
						}
						else if(listMethods[i] == 'Sevidg'){
							data += '<tr>'
							data += '<th scope="row">'+ (i+1) +'</th>';
							data += '<td class="td-no-padding"><input required readonly name="Sevidg" class="form-control input-no-margin text-center" value="По Сэвиджу"></input></td>';
							data += '<td class="td-no-padding"><input required readonly name="Sevidg_value" id="Sevidg" class="form-control input-no-margin text-center" value="'+ Sevidg(utilityMatrix, altenatives_val) +'"></input></td>';
							data += '</tr>';
						}
						else if(listMethods[i] == 'Gurvich'){
							data += '<tr>'
							data += '<th scope="row">'+ (i+1) +'</th>';
							data += '<td class="td-no-padding"><input required readonly name="Gurvich" class="form-control input-no-margin text-center" value="По Гурвицу"></input></td>';
							data += '<td class="td-no-padding"><input required readonly name="Gurvich_value" id="Gurvich" class="form-control input-no-margin text-center" value="'+ Gurvich(utilityMatrix, altenatives_val) +'"></input></td>';
							data += '</tr>';
						}
						
				}
				Sevidg(utilityMatrix, altenatives_val);
				data +=     '</tbody>\
							</table>\
						  </div>\
						</div>';
				
				data += '<div class="row">';

				var msg = "getCookie=0";
				var isRegistered = false;
				$.ajax({
	              type: 'POST',
	              url: 'handler.php',
	              data: msg,
	              success: function(data) {
	                if(data != ''){
	                	isRegistered = true;
	                }
	              },
	              error:  function(xhr, str){
	              console.log('Возникла ошибка: ' + xhr.responseCode);
	              },
	              async: false
	          	});
	          	if(isRegistered){
	          		data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="button" style="width: 100%;" id="save-matrix-method" class="btn btn-ghost btn-primary waves-effect waves-light">Сохранить и перейти в личный кабинет</button>\
						 </div>';
	          	}
	          	else{
	          		data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="submit" style="width: 100%;"  class="btn btn-ghost btn-primary waves-effect waves-light">Провести новое испытание</button>\
						 </div>';
	          	}
				
				data +=	'</div>\
						</div>';
				
				$(data).appendTo('.last-step').show('slow');
				
			}
			else{
				alert('Введите альфа или выберите хотя бы один метод');
			}
		}
	});
	$('body').on('click', '#save-matrix-method', function(){
		var msg = $('#matrixMethod').serialize();
		msg += "&amount_criterians=" + amount_conditions + "&amount_alternatives=" + amount_alternatives + "&methodType=matrixMethod" + "&getCookie=0";

		//отправляем файлу handler php данные, а также ожидаем от него куки с id пользователя
		$.ajax({
          type: 'POST',
          url: 'handler.php',
          data: msg,
          success: function(data) {
            $(location).attr('href',"account.php?user_id=" + data);
            //console.log(data);
          },
          error:  function(xhr, str){
	      	console.log('Возникла ошибка: ' + xhr.responseCode);
          }
        });
	});
	
	function Laplas(utilityMatrix, altVal){
		
	    var total_results = []; //массив для значений по методу Лапласа
		
		//считаем значения по методу вальда
		for(var i = 0; i < utilityMatrix.length; i++){
			var summ = 0;
			for(var j = 0; j < utilityMatrix[i].length; j++){
				summ += utilityMatrix[i][j];
			}
			total_results.push(summ/utilityMatrix[i].length);
		}

		var max = total_results[0]; //максимальное значение по Лапласа 
		var result = altVal[0]; //строковое значение по методу Лапласа
		
		for(var i = 0; i < total_results.length; i++){
			if(max < total_results[i]){
				max = total_results[i];
				result = altVal[i];
			}
		}

		return result;
	}
	function Vald(utilityMatrix, altVal){
		
	    var total_results = []; //массив для значений по методу Лапласа
		
		//считаем значения по методу вальда
		for(var i = 0; i < utilityMatrix.length; i++){
			var min = utilityMatrix[i][0];
			for(var j = 0; j < utilityMatrix[i].length; j++){
				if(min > utilityMatrix[i][j]){
					min = utilityMatrix[i][j];
				}
			}
			total_results.push(min);
		}
		
		var max = total_results[0]; //максимальное значение по Лапласа 
		var result = altVal[0]; //строковое значение по методу Лапласа
		
		for(var i = 0; i < total_results.length; i++){
			if(max < total_results[i]){
				max = total_results[i];
				result = altVal[i];
			}
		}

		return result;
	}
	
	function Sevidg(utilityMatrix, altVal){
		
	    var total_results = []; 
		//находим максимальное по столбцам
		for(var i = 0; i < utilityMatrix[0].length; i++){
			var max = utilityMatrix[0][i];
			for(var j =0; j < utilityMatrix.length; j++){
				if(max < utilityMatrix[j][i]){
					max = utilityMatrix[j][i];
				}
			}
			total_results.push(max);
		}
		//строим матрицу рисков
		for(var i = 0; i < utilityMatrix[0].length; i++){
			var max = utilityMatrix[0][i];
			for(var j =0; j < utilityMatrix.length; j++){
				utilityMatrix[j][i] = total_results[i] - utilityMatrix[j][i];
			}
		}
		
		total_results = [];
		//находимм максимальное в матрице рисков по строкам
		for(var i = 0; i < utilityMatrix.length; i++){
			var max = utilityMatrix[i][0];
			for(var j = 0; j < utilityMatrix[i].length; j++){
				if(max < utilityMatrix[i][j]){
					max = utilityMatrix[i][j];
				}
			}
			total_results.push(max);
		}
		
		
		var min = total_results[0];
		//находим минимальное среди максимальных по строкам
		for(var i = 0; i < total_results.length; i++){
			if(min > total_results[i]){
				min = total_results[i];
			}
		}
		
		var result = [];
		
		for(var i = 0; i < total_results.length; i++){
			if(min == total_results[i]){
				result.push(altVal[i]);
			}
		}
		return result;
	}
	
	
	function Gurvich(utilityMatrix, altVal){
		
	    var total_results_min = []; //минимальное по строкам
		var total_results_max = []; // максимальное по строкам
		var alfa = eval($('#alfa').val()); //алфа
		var total_results = []; //результаты вычисление по методу Гурвеца по строкам
		
		//находим минимальные и максимальные значения по строкам
		for(var i = 0; i < utilityMatrix.length; i++){
			
			var min = utilityMatrix[i][0];
			var max = utilityMatrix[i][0];
			
			for(var j = 0; j < utilityMatrix[i].length; j++){
				if(min > utilityMatrix[i][j]){
					min = utilityMatrix[i][j];
				}
				if(max < utilityMatrix[i][j]){
					max = utilityMatrix[i][j];
				}
			}
			total_results_min.push(min);
			total_results_max.push(max);
		}
		//делаем расчеты по Гурвицу по строкам
		for(var i = 0; i < utilityMatrix.length; i++){
			var res = alfa * total_results_min[i] + (1 - alfa) * total_results_max[i];
			total_results.push(res);
		}
		
		var max = total_results[0]; //максимальное значение по Гурвицу 
		var result = altVal[0]; //строковое значение по методу Гурвица
		
		for(var i = 0; i < total_results.length; i++){
			if(max < total_results[i]){
				max = total_results[i];
				result = altVal[i];
			}
		}
		
		return result;
	}
	
	
	
	//в условиях риска
	//в условиях риска
	//в условиях риска
	
	var max = 12; //максимальное число критериев или альтернатив
	var amount_alternatives = 2; //количество альтернатив 
	var amount_states = 2; //количество критериев 
	var altenatives_val = []; // строковые значения альтернатив
	var states_val = []; // строковые значения критериев
	var count_pareto_val = 0; //значение числа парето для передачи в handler
	
	//добавляем альтернативу
	$('#plus-alternative-risk-method').on('click', function(){
		if(amount_alternatives < max){
			amount_alternatives++;
			$('#tbody-alternatives-risk-method').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">'+ amount_alternatives +'</th>' +
					'<td class="td-no-padding"><input name="alternative_'+ (amount_alternatives - 1) +'" required placeholder="Альтернатива'+ amount_alternatives +'" class="form-control input-no-margin" placeholder="Алтернатива '+ amount_criterians +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-alternatives-risk-method').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество критериев');
		}
	});
    //удаляем альтернативу
	$('#minus-alternative-risk-method').on('click', function(){
		if(amount_alternatives != 2){
			amount_alternatives--;
			$('#tbody-alternatives-risk-method').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	//добавляем состояние среды
	$('#plus-state-risk-method').on('click', function(){
		if(amount_states < max){
			amount_states++;
			$('#tbody-states-risk-method').find('tr').eq(-1).after(
				'<tr style="display: none;">'+
					'<th scope="row">'+ amount_states +'</th>' +
					'<td class="td-no-padding"><input name="criterian_'+ (amount_states - 1) +'" required placeholder="Состояние'+ amount_states +'" class="form-control input-no-margin" placeholder="Условие '+ amount_alternatives +'"></input></td>'
				+ '</tr>'
			);
			$('#tbody-states-risk-method').find('tr').eq(-1).show(1000);
		}
		else{
			alert('Ошибка: слишком большое количество альтернатив');
		}
	});
	//удаляем состояние среды
	$('#minus-state-risk-method').on('click', function(){
		
		if(amount_states != 2){
			amount_states--;
			$('#tbody-states-risk-method').find('tr').eq(-1).fadeToggle(200, function(){
				$(this).remove();
			});
		}
	});
	
	$('body').on('click', '#build-risk-method', function(){
		if($('#purpose_area_risk_method').val() != '')
		{
			var flag = true;
			var altenatives = $('#tbody-alternatives-risk-method > tr');
			var states = $('#tbody-states-risk-method > tr');
			
			for(var i = 0; i < amount_alternatives; i++){

				var value = altenatives.eq(i).find('td').find('input').val();
				
				if(value != ''){
					altenatives_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			
			for(var i = 0; i < amount_states; i++){

				var value = states.eq(i).find('td').find('input').val();
				
				if(value != ''){
					states_val.push(value);
				}
				else{
					flag = false;
					break;
				}
			}
			if(flag){
				//строим матрицу парных сравнений
				var data = '\
				<div style="display:none">\
					<h3 class="block-title block-title-no-margin text-center">Шаг 2</h3>\
					<h5 class="block-title text-center">Заполните матрицу полезности:</h5>\
					<div class="row">\
					  <div class="col-lg-12 col-md-12 col-sm-12">\
						<div class="table-responsive space-bottom-1x">\
						   <table class="table-responsive" id="winnings_matrix">\
							<thead>\
								<tr>\
								<th>#</th>\
				';
				for(var i = 0; i < amount_states; i++){
					data += '<th>'+ states_val[i] +'</th>';
				}
				
				data += 		'</tr>\
							</thead>\
							<tbody>';
				data += '<tr>'
				data += '<th scope="row">P</th>';

				for(var i = 0; i < amount_states; i++){
					data += '<td class="td-no-padding"><input name="winnings_matrix_p_'+ i +'" id="winnings_matrix_p_'+ i +'" required class="form-control input-no-margin text-center"></input></td>';
				}
				
				data += '</tr>';

				for(var i = 0; i < amount_alternatives; i++){
					data += '<tr>'
					data += '<th scope="row">'+ altenatives_val[i] +'</th>';
					for(var j = 0; j < amount_states; j++){
						data += '<td class="td-no-padding"><input name="winnings_matrix_'+ i +'_'+ j +'" id="winnings_matrix_'+ i +'_'+ j +'" required class="form-control input-no-margin text-center"></input></td>';
					}
					data += '</tr>';
				}
				
				data +=     '</tbody>\
							</table>\
						  </div>\
						</div>';
				
				data += '<div class="row">'
				data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="button" id="solve-risk-method" class="btn btn-no-margin-top btn-block btn-ghost btn-default waves-effect waves-light">Рассчитать</button>\
						</div>';
				
				data +=	'</div>\
						</div>';
				
				$(data).appendTo('.second-step').show('slow');
				$('body').find('#build-risk-method').attr('id', 'build-risk-method-used');
			}
			else{
				alert('Заполните все поля');
			}
		}
		else{
			alert("Введите цель");
		}
	});

	
	$('body').on('click', '#solve-risk-method', function(){
		
		var probabilities = []; //вероятность наступления определенного состояния
		var winnings_matrix = []; //матрица выйгрышей
		var anticipatedWin = []; //ожидаемый выйгрыш 
		var deviation = []; //средне квадратичное отклонение
		var count_pareto = 0; // количество оптимальных альтернатив
		var q_L_min = []; //обобщеный критерий при минимальной лямда
		var q_L_av = []; //обобщеный критерий при средней Лямбда
		var q_L_max = []; //обобщеный критерий при максимальной лямбда
		var indexesAltName = []; 
		var flag_probabilities = true; //если false то будет ошибка вер. должна быть равна 1
		var flag_occupancy = true; //должны быть заполнены все значения в матрице
		
		if(clicker){
			clicker = false;
			$('.risk-method-solve').hide('slow', function(){
				$('.risk-method-solve').remove();
			});
		}
		else{
			clicker = true;
			
			var summ_p = 0;
			for(var i = 0; i < amount_states; i++){
				summ_p += eval($('#winnings_matrix_p_' + i).val());
			}
			if(summ_p != 1){
				flag_probabilities = false;
			}
			
			for(var i = 0; i < amount_alternatives; i++){
				for(var j = 0; j < amount_states; j++){
					if($('#winnings_matrix_' + i + '_' + j).val() == ''){
						flag_occupancy = false;
					}
				}
			}
			
			if(flag_probabilities && flag_occupancy){
				//заполняем вероятности
				for(var i = 0; i < amount_states; i++){
					probabilities.push($('#winnings_matrix_p_' + i).val());
				}
				//заполняем матрицу выйгрышей 
				for(var i = 0; i < amount_alternatives; i++){
					winnings_matrix[i] = new Array();
					for(var j = 0; j < amount_states; j++){
						winnings_matrix[i][j] = eval($('#winnings_matrix_' + i + '_' + j).val());
					}
				}
				//считаем ожидаемый выйгрыш 
				for(var i = 0; i < amount_alternatives; i++){
					var summ = 0;
					for(var j = 0; j < amount_states; j++){
						summ += winnings_matrix[i][j] * probabilities[j];
					}
					anticipatedWin.push(summ);
				}
				//считаем средне квадратичное отклонение
				for(var i = 0; i < amount_alternatives; i++){
					var dispersian = 0;
					for(var j = 0; j < amount_states; j++){
						dispersian += Math.pow(winnings_matrix[i][j],2) * probabilities[j];
					}
					dispersian -= Math.pow(anticipatedWin[i],2);
					deviation.push(Math.sqrt(dispersian));
				}
				
				var dominantAlternatives = [];//доминируемые альтернативы заполняем 1
				
				//заполняем 1
				for(var i = 0; i < amount_alternatives; i++){
					dominantAlternatives.push(1);
				}
				
				//организуем цикл, в котором сравниваем попарно альтернативы и отбрасываем доминируемые
				for(var i = 0; i < amount_alternatives; i++){
					//эта альтернатива доминируемая и ее анализировать не надо
					if(dominantAlternatives[i] == 0) {
						continue;
					}
					
					for(var j = 0; j < amount_alternatives; j++){
						
						if(dominantAlternatives[j] == 0){
							continue;
						}
						
						//альтернативу саму с собой не сравниваем
						if(i == j) {
							continue;
						}
						
						// счетчик числа критериев, по которым i-ая альтернатива ЛУЧШЕ j-ой
						var count_better = 0; 
						// счетчик числа критериев, по которым i-ая альтернатива ХУЖЕ j-ой
						var count_worse = 0; 
						
						if(anticipatedWin[i] > anticipatedWin[j]){
							count_better++;
						}
						else if (anticipatedWin[i] < anticipatedWin[j]){
							count_worse++;
						}
						
						if(deviation[i] < deviation[j]){
							count_better++;
						}
						else if(deviation[i] > deviation[j]){
							count_worse++;
						}
						
						if(count_better > 0 && count_worse == 0){
							dominantAlternatives[j] = 0;
						}
						else if(count_better == 0 && count_worse > 0){
							dominantAlternatives[i] = 0;
						}
						else{
							;
						}
					}
				}
				
				//находим количество оптимальных альтернатив;
				var anticipatedWinSort = [];
				var deviationSort = [];
				
				//цикл определения значений лямбда для всех попарных комбинаций альтернатив
				for(var i = 0; i < dominantAlternatives.length; i++){
					if(dominantAlternatives[i] == 1){
						anticipatedWinSort.push(anticipatedWin[i]);
						deviationSort.push(deviation[i]);
						indexesAltName.push(altenatives_val[i]);
						count_pareto++;
					}
				}
				
				count_pareto_val = count_pareto;
				//массив всех значений лямбда, для того чтобы из них всех найти макс и мин
				var lambdas = [];
				
				for(var i = 0; i < anticipatedWinSort.length; i++){
					for(var j = i+1; j < anticipatedWinSort.length; j++){
						var lambda = (anticipatedWinSort[i] - anticipatedWinSort[j]) / (deviationSort[i] - deviationSort[j]); 
						lambdas.push(lambda);		
					}
				}
				lambdas.sort();
				var lambda_min = lambdas[0];
				var lambda_max = lambdas[lambdas.length - 1];
			
				//формируем 3 варианта ранжировок
				//первый вариант: лямбда_ЛПР < лямбда_мин
				var lambda_lpr = lambda_min/2; 
				
				for(var i = 0; i < count_pareto; i++){
					q_L_min[i] = new Array();
					q_L_min[i][0] = anticipatedWinSort[i] - deviationSort[i] * lambda_lpr;
					q_L_min[i][1] = indexesAltName[i];
				}
				
				//при среднем лямбда
				lambda_lpr = (lambda_min + lambda_max)/2; 
				
				for(var i = 0; i < count_pareto; i++){
					q_L_av[i] = new Array();
					q_L_av[i][0] = anticipatedWinSort[i] - deviationSort[i] * lambda_lpr;
					q_L_av[i][1] = indexesAltName[i];
				}
				
				//при лямбда больше max
				lambda_lpr = lambda_max * 2;
				
				for(var i = 0; i < count_pareto; i++){
					q_L_max[i] = new Array();
					q_L_max[i][0] = anticipatedWinSort[i] - deviationSort[i] * lambda_lpr;
					q_L_max[i][1] = indexesAltName[i];
				}
				
				sorting(q_L_min);
				sorting(q_L_av);
				sorting(q_L_max);
				var mass = [q_L_min, q_L_av, q_L_max];
				var data = '\
					<div style="display:none" class="risk-method-solve">\
					<h3 class="block-title block-title-no-margin text-center">Результат<small><span class="text-default"></span>Цель: '+ $('#purpose_area_risk_method').val() +'</small></h3><br><br>\
						<div class="row">\
						  <div class="col-lg-4 col-md-12 col-sm-12">\
							<div class="table-responsive space-bottom-1x">\
							   <table class="table-responsive" id="risk-method-result-hight">\
								<thead>\
									<tr>\
									<th>#</th>\
									<th style="background-color: rgba(255,0,0,0.4)">Высокий уровень риска</th>\
							';
				
					
				data += 		'</tr>\
								</thead>\
							<tbody>';
							
				
				for(var i = 0; i < count_pareto; i++){
					data += '<tr>'
					data += '<th scope="row">'+ (i+1) +'</th>';
					data += '<td class="td-no-padding"><input name="hight_risk_'+ i +'" value="' + q_L_min[i][1] + '" id="small-risks_'+ i +'" required class="form-control input-no-margin text-center"></input></td>';
					data += '</tr>';
				}
					
				data +=     '</tbody>';
				
				data += '<thead>\
									<tr>\
									<th></th>\
									<th>Оптимальный выбор</th>\
									</tr>\
						</thead>';
						
				data +=	'<tbody>\
							<tr>\
							<th scope="row"></th>\
								<td class="td-no-padding"><input value="' + q_L_min[0][1] + '" id="small-risks-res-L-min" readonly required class="form-control input-no-margin text-center"></input></td>\
							</tr>\
						</tbody>';
						
						
				data +=			'</table>\
								</div>\
							</div>';
							
							
				//зона неопределенности
				data += '<div class="col-lg-4 col-md-12 col-sm-12">\
							<div class="table-responsive space-bottom-1x">\
							   <table class="table-responsive" id="risk-method-result-av">\
								<thead>\
									<tr>\
									<th>#</th>\
									<th style="background-color: rgba(0,0,255,0.4)">Среднее значение</th>\
							';
				
					
				data += 		'</tr>\
								</thead>\
							<tbody>';
							
				
				for(var i = 0; i < count_pareto; i++){
					data += '<tr>'
					data += '<th scope="row">'+ (i+1) +'</th>';
					data += '<td class="td-no-padding"><input name="middle_risk_'+ i +'" value="' + q_L_av[i][1] + '" id="av-risk_'+ i + '" required class="form-control input-no-margin text-center"></input></td>';
					data += '</tr>';
				}
					
				data +=     '</tbody>';
				
				data += '<thead>\
									<tr>\
									<th></th>\
									<th>Оптимальный выбор</th>\
									</tr>\
						</thead>';
						
				data +=	'<tbody>\
							<tr>\
							<th scope="row"></th>\
								<td class="td-no-padding"><input value="' + q_L_av[0][1] + '" id="small-risks-res-L-av" readonly required class="form-control input-no-margin text-center"></input></td>\
							</tr>\
						</tbody>';
						
						
				data +=			'</table>\
								</div>\
							</div>';
				
				//зона большой несклонности к риску
				data += '<div class="col-lg-4 col-md-12 col-sm-12">\
							<div class="table-responsive space-bottom-1x">\
							   <table class="table-responsive" id="risk-method-result-low">\
								<thead>\
									<tr>\
									<th>#</th>\
									<th style="background-color: rgba(0,255,0,0.4)">Низкий уровень риска</th>\
							';
				
					
				data += 		'</tr>\
								</thead>\
							<tbody>';
							
				
				for(var i = 0; i < count_pareto; i++){
					data += '<tr>'
					data += '<th scope="row">'+ (i+1) +'</th>';
					data += '<td class="td-no-padding"><input name="low_risk_'+ i +'" value="' + q_L_max[i][1] + '" id="max-risk_'+ i + '" required class="form-control input-no-margin text-center"></input></td>';
					data += '</tr>';
				}
					
				data +=     '</tbody>';
				
				data += '<thead>\
									<tr>\
									<th></th>\
									<th>Оптимальный выбор</th>\
									</tr>\
						</thead>';
						
				data +=	'<tbody>\
							<tr>\
							<th scope="row"></th>\
								<td class="td-no-padding"><input value="' + q_L_max[0][1] + '" id="small-risks-res-L-av" readonly required class="form-control input-no-margin text-center"></input></td>\
							</tr>\
						</tbody>';
						
						
				data +=			'</table>\
								</div>\
							</div>';
							
				data += '<div class="row">';

				var msg = "getCookie=0";
				var isRegistered = false;
				$.ajax({
	              type: 'POST',
	              url: 'handler.php',
	              data: msg,
	              success: function(data) {
	                if(data != ''){
	                	isRegistered = true;
	                }
	              },
	              error:  function(xhr, str){
	              console.log('Возникла ошибка: ' + xhr.responseCode);
	              },
	              async: false
	          	});
	          	if(isRegistered){
	          		data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="button" style="width: 100%;" id="save-risk-method" class="btn btn-ghost btn-primary waves-effect waves-light">Сохранить и перейти в личный кабинет</button>\
						 </div>';
	          	}
	          	else{
	          		data += '<div class="col-lg-12 col-md-12 col-sm-12">\
							 <button type="submit" style="width: 100%;" class="btn btn-ghost btn-primary waves-effect waves-light">Провести новое испытание</button>\
						 </div>';
	          	}
				
						 
				data +=	  '</div>'
				
				data +=	'</div>';
					
				$(data).appendTo('.third-step').show('slow');
				
			}
			else if(flag_probabilities == false){
				alert('Сумма вероятностей должна быть равна 1');
			}
			else if(flag_occupancy == false){
				alert('Заполните матрицу полностью');
			}
		}
	});
	
	$('body').on('click', '#save-risk-method', function(){

		var msg = $('#risk-method').serialize();
		msg += "&amount_criterians=" + amount_states + "&amount_alternatives=" + amount_alternatives + "&count_pareto=" + count_pareto_val + "&methodType=riskMethod" + "&getCookie=0";
		
		//отправляем файлу handler php данные, а также ожидаем от него куки с id пользователя
		$.ajax({
          type: 'POST',
          url: 'handler.php',
          data: msg,
          success: function(data) {
            $(location).attr('href',"account.php?user_id=" + data);
            //console.log(data);
          },
          error:  function(xhr, str){
	      	console.log('Возникла ошибка: ' + xhr.responseCode);
          }
        });
	});
	function sorting(arr){
		for(var i = 0; i < arr.length - 1; i++){
			for(var j = 0; j < arr.length - i - 1; j++){
				
				if(arr[j][0] < arr[j+1][0]){
					var value = arr[j][0];
					var key = arr[j][1];
					
					arr[j][0] = arr[j+1][0];
					arr[j][1] = arr[j+1][1];
					
					arr[j+1][0] = value;
					arr[j+1][1] = key;
				}
				
			}
		}
	}




	
	// Disable default link behavior for dummy links that have href='#'
	var $emptyLink = $('a[href=#]');
	$emptyLink.on('click', function(e){
		e.preventDefault();
	});

	// Stuck navbar on scroll
	if($('.navbar-sticky').length && $('.main-navigation').length) {
		var sticky = new Waypoint.Sticky({
		  element: $('.navbar-sticky .main-navigation')[0]
		});
	}

	// Search form expand (Topbar)
	var $searchToggle = $('.search-btn > i, .toolbar');
	$searchToggle.on('click', function(){
		$(this).parent().find('.search-box').addClass('open');
	});
	$('.search-btn').on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$('.search-box').removeClass('open');
	});

	// Waves Effect (on Buttons)
	if($('.waves-effect').length > 0) {
		Waves.displayEffect( { duration: 600 } );
	}

	// Animated Scroll to Top Button
	var $scrollTop = $('.scroll-to-top-btn');
	if ($scrollTop.length > 0) {
		$(window).on('scroll', function(){
	    if ($(window).scrollTop() > 600) {
	      $scrollTop.addClass('visible');
	    } else {
	      $scrollTop.removeClass('visible');
	    }
		});
		$scrollTop.on('click', function(e){
			e.preventDefault();
			$('html').velocity("scroll", { offset: 0, duration: 1000, easing:'easeOutExpo', mobileHA: false });
		});
	}
	
	// Smooth scroll to element
	var $scrollTo = $('.scroll-to');
	$scrollTo.on('click', function(event){
		var $elemOffsetTop = $(this).data('offset-top');
		$('html').velocity("scroll", { offset:$(this.hash).offset().top-$elemOffsetTop, duration: 1000, easing:'easeOutExpo', mobileHA: false});
		event.preventDefault();
	});


	// Toggle Mobile Navigation
	var $navToggle = $('.nav-toggle', '.navbar');
	$navToggle.on('click', function(){
		$(this).toggleClass('active').parents('.navbar').find('.toolbar, .main-navigation, .mobile-socials').toggleClass('expanded');
	});

	// Mobile Submenu
	var $hasSubmenu = $('.menu-item-has-children > a', '.main-navigation');
	$hasSubmenu.on('click', function(){
		$(this).parent().toggleClass('active').find('.sub-menu, .mega-menu').toggleClass('expanded');
	});

	// Custom Checkboxes and Radios
	if($('input[type=checkbox], input[type=radio]').length) {
		$('input').iCheck();
	}

	// Toggleable Switch component
	var $sWitch = $('.switch');
	$sWitch.on('click', function(){

	  var clicks = $(this).data('clicks'),
	  		inputVal = $(this).find('input').attr('value');

		if (clicks && inputVal == 'off') {
			$(this).find('input').attr('value', 'on');
			$(this).addClass('on');
		} else if (clicks && inputVal == 'on') {
			$(this).find('input').attr('value', 'off');
			$(this).removeClass('on');
		} else if (!clicks && inputVal == 'off') {
			$(this).find('input').attr('value', 'on');
			$(this).addClass('on');
		} else if (!clicks && inputVal == 'on') {
			$(this).find('input').attr('value', 'off');
			$(this).removeClass('on');
		}

		$(this).data("clicks", !clicks);

	});

	// Count Input
	$('.count-input .incr-btn').on('click', function(e) {
		var $button = $(this);
		var oldValue = $button.parent().find('.quantity').val();
		$button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
		if ($button.data('action') == "increase") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
		 // Don't allow decrementing below 1
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
				$button.addClass('inactive');
			}
		}
		$button.parent().find('.quantity').val(newVal);
		e.preventDefault();
	});

	// Feature Tabs (Changing screens of Tablet and Phone)
  $('.feature-tabs .nav-tabs li a').on('click', function() {
	  var currentPhoneSlide = $(this).data("phone");
	  var currentTabletSlide = $(this).data("tablet");
	  $(".devices .phone .screens li").removeClass("active");
	  $(".devices .tablet .screens li").removeClass("active");
	  $(currentPhoneSlide).addClass("active");
	  $(currentTabletSlide).addClass("active");
  });

  // Feature Tabs Autoswitching
	if($('.feature-tabs .nav-tabs[data-autoswitch]').length > 0) {
    var changeInterval = $('.feature-tabs .nav-tabs').data('interval');
		var tabCarousel = setInterval(function() {
	        var tabs = $('.feature-tabs .nav-tabs > li'),
	            active = tabs.filter('.active'),
	            next = active.next('li'),
	            toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

	        toClick.trigger('click');
	  }, changeInterval);
	}

	// Tooltips
	var $tooltip = $('[data-toggle="tooltip"]');
	if ( $tooltip.length > 0 ) {
		$tooltip.tooltip();
	}

	// Tile Tabs Switching Class
	var $tileTab = $('.tile-tabs .tab');
	$tileTab.on('click', function(){
		$tileTab.removeClass('active');
		$(this).addClass('active');
	});

	// Domain Types Dropdown
	var $domainDropdown = $('.domain-dropdown > span'),
			$domainDropdownWrap = $('.domain-dropdown');
	$domainDropdown.on('click', function() {
		$(this).parent().toggleClass('active');
	});
	$domainDropdownWrap.on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$domainDropdownWrap.removeClass('active');
	});

	// Shop Filters Dropdown
	var $shopDropdown = $('.shop-filter-dropdown > span'),
			$shopDropdownWrap = $('.shop-filter-dropdown');
	$shopDropdown.on('click', function() {
		$shopDropdown.parent().removeClass('active');
		$(this).parent().addClass('active');
	});
	$shopDropdownWrap.on('click', function(e) {
    e.stopPropagation();
	});
	$(document).on('click', function(e) {
		$shopDropdownWrap.removeClass('active');
	});

	// Progress Bars on Scroll Animation
	function pbOnScrollAnimation( items, trigger ) {
	  items.each( function() {
	    var pbElement = $(this),
	        curVal = pbElement.find('.progress-bar').attr('data-valuenow');

	    var pbTrigger = ( trigger ) ? trigger : pbElement;

	    pbTrigger.waypoint(function() {
	      	pbElement.find('.progress-bar').css({'width': curVal + '%'});
	    },{
	        offset: '90%'
	    });
	  });
	}
	pbOnScrollAnimation( $('.progress-animated') );

	// Counters (Animated Digits)
	function counterOnScrollAnimation( items, trigger ) {
	  items.each( function() {
	    var counterElement = $(this),
	        decimals = $(this).data('decimals'),
	        duration = $(this).data('duration');

	    var counterTrigger = ( trigger ) ? trigger : counterElement;

	    counterTrigger.waypoint(function(direction) {
				  	if(direction == 'down') {
			      	counterElement.find('.digits').spincrement({
									from: 0.0,
									decimalPlaces: decimals,
									duration: duration
							});
				  	} else {
				  		this.destroy();
				  	}
	    },{
	        offset: '95%'
	    });
	  });
	}
	counterOnScrollAnimation( $('.counter') );

	// Countdown Function
	function countDownFunc( items, trigger ) {
		items.each( function() {
			var countDown = $(this),
					dateTime = $(this).data('date-time');

			var countDownTrigger = ( trigger ) ? trigger : countDown;
			countDownTrigger.downCount({
		      date: dateTime,
		      offset: +10
		  });
		});
	}
	countDownFunc( $('.countdown') );


	// On window load functions
	$(window).on('load', function(){

		// Isotope Grid
		var $grid = $('.isotope-masonry-grid, .isotope-grid');
		if($grid.length > 0) {
		  $grid.isotope({
			  itemSelector: '.grid-item',
			  transitionDuration: '0.7s',
			  masonry: {
			    columnWidth: '.grid-sizer',
			    gutter: '.gutter-sizer'
			  }
		  });
		}

		// Filtering
		if($('.filter-grid').length > 0) {
		  var $filterGrid = $('.filter-grid');
			$('.nav-filters').on( 'click', 'a', function(e) {
				e.preventDefault();
				$('.nav-filters li').removeClass('active');
				$(this).parent().addClass('active');
			  var $filterValue = $(this).attr('data-filter');
			  $filterGrid.isotope({ filter: $filterValue });
			});
		}

		/** Background Parallax **/
		if ( ! Modernizr.touch && ! $('html.ie').length ) {
			if ( $( "body.parallax" ).length > 0 ) {
				$.stellar( {
					scrollProperty: 'scroll',
					verticalOffset: 0,
					horizontalOffset: 0,
					horizontalScrolling: false,
					responsive: true
				} );
				$grid.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
					$.stellar('refresh');
				});
			}
		}
	});

	// Scroll Reveal Animations
	if($('.scrollReveal').length && ! $('html.ie9').length) {
		$('.scrollReveal').parent().css('overflow', 'hidden');
		window.sr = ScrollReveal({
			reset: true,
			distance: '32px',
			mobile: true,
			duration: 850,
			scale: 1,
			viewFactor: 0.3,
			easing: 'ease-in-out'
		});
		sr.reveal('.sr-top', { origin: 'top' });
		sr.reveal('.sr-bottom', { origin: 'bottom' });
		sr.reveal('.sr-left', { origin: 'left' });
		sr.reveal('.sr-long-left', { origin: 'left', distance: '70px', duration: 1000 });
		sr.reveal('.sr-right', { origin: 'right' });
		sr.reveal('.sr-scaleUp', { scale: '0.8' });
		sr.reveal('.sr-scaleDown', { scale: '1.15' });

		sr.reveal('.sr-delay-1', { delay: 200 });
		sr.reveal('.sr-delay-2', { delay: 400 });
		sr.reveal('.sr-delay-3', { delay: 600 });
		sr.reveal('.sr-delay-4', { delay: 800 });
		sr.reveal('.sr-delay-5', { delay: 1000 });
		sr.reveal('.sr-delay-6', { delay: 1200 });
		sr.reveal('.sr-delay-7', { delay: 1400 });
		sr.reveal('.sr-delay-8', { delay: 1600 });

		sr.reveal('.sr-ease-in-out-quad', { easing: 'cubic-bezier(0.455,  0.030, 0.515, 0.955)' });
		sr.reveal('.sr-ease-in-out-cubic', { easing: 'cubic-bezier(0.645,  0.045, 0.355, 1.000)' });
		sr.reveal('.sr-ease-in-out-quart', { easing: 'cubic-bezier(0.770,  0.000, 0.175, 1.000)' });
		sr.reveal('.sr-ease-in-out-quint', { easing: 'cubic-bezier(0.860,  0.000, 0.070, 1.000)' });
		sr.reveal('.sr-ease-in-out-sine', { easing: 'cubic-bezier(0.445,  0.050, 0.550, 0.950)' });
		sr.reveal('.sr-ease-in-out-expo', { easing: 'cubic-bezier(1.000,  0.000, 0.000, 1.000)' });
		sr.reveal('.sr-ease-in-out-circ', { easing: 'cubic-bezier(0.785,  0.135, 0.150, 0.860)' });
		sr.reveal('.sr-ease-in-out-back', { easing: 'cubic-bezier(0.680, -0.550, 0.265, 1.550)' });
	}

	// Contacts Slider (Master Slider)
	if($('#contact-slider').length) {
		var contactSlider = new MasterSlider();

		contactSlider.control('arrows');

		contactSlider.setup('contact-slider' , {
			width:1140,
			height:480,
			space:0,
			loop:true,
			view:'basic',
			layout:'partialview',
	    filters: {
	      opacity: 0.1
	    }
		});
	}

	// Conference Slider (Master Slider)
	if($('#conference-slider').length) {
		var conferSlider = new MasterSlider();

		conferSlider.control('arrows', {hideUnder: 800});
		conferSlider.control("bullets", {autohide:false});
		conferSlider.control('timebar', {color: 'rgba(255,255,255,.5)', align: 'top'});

		conferSlider.setup('conference-slider' , {
			width: 1920,
			height: 10,
			space: 0,
			layout: "fillwidth",
      autoHeight: true,
      loop: true,
      view: 'flow',
      autoplay: true
		});
	}

	// Intro Page Slider (Master Slider)
	if($('#intro-slider').length) {
		var introSlider = new MasterSlider();

		introSlider.control('arrows', {hideUnder: 800});
		introSlider.control("bullets", {autohide:false});

		introSlider.setup('intro-slider' , {
			width: 1920,
			height: 10,
			space: 0,
			layout: "fillwidth",
      autoHeight: true,
      loop: true,
      view: 'stack'
		});
	}

	// Image Carousel
	var $imageCarousel = $( '.image-carousel .inner' );
	if ( $imageCarousel.length > 0 ) {
		$imageCarousel.each( function () {

			var dataLoop 	 = $( this ).parent().data( 'loop' ),
					autoPlay   = $( this ).parent().data( 'autoplay' ),
					timeOut    = $( this ).parent().data( 'interval' ),
					autoheight = $( this ).parent().data( 'autoheight' );

			$( this ).owlCarousel( {
				items: 1,
				loop: dataLoop,
				margin: 0,
				nav: true,
				dots: false,
				navText: [ , ],
				autoplay: autoPlay,
				autoplayTimeout: timeOut,
				autoHeight: autoheight
			} );
		} );
	}

	// Logo Carousel
	var $logoCarousel = $( '.logo-carousel .inner' );
	if ( $logoCarousel.length > 0 ) {
		$logoCarousel.each( function () {

			var dataLoop 	 = $( this ).parent().data( 'loop' ),
					autoPlay = $( this ).parent().data( 'autoplay' ),
					timeOut = $( this ).parent().data( 'interval' );

			$( this ).owlCarousel( {
				loop: dataLoop,
				margin: 20,
				nav: false,
				dots: false,
				autoplay: autoPlay,
				autoplayTimeout: timeOut,
				responsiveClass: true,
				responsive: {
					0: { items: 2 },
					480: { items: 3 },
					700: { items: 4 },
					1000: { items: 5 },
					1200: { items: 6 },
				}
			} );
		} );
	}

	// Gallery Popup
	var $gallItem = $( '.gallery-item' );
	if( $gallItem.length > 0 ) {
		$gallItem.magnificPopup( {
		  type: 'image',
		  mainClass: 'mfp-fade',
		  gallery: {
		    enabled: true
		  },
		  removalDelay: 500,
		  image: {
		  	titleSrc: 'data-title'
		  }
		} );
	}

	// Video Popup
	var $videoBtn = $( '.video-popup-btn > .play-btn, .video-popup-tile .play-btn' );
	if( $videoBtn.length > 0 ) {
		$videoBtn.magnificPopup( {
		  type: 'iframe',
		  mainClass: 'mfp-fade',
		  removalDelay: 500
		} );
	}


	// Google Maps API
	var $googleMap = $('.google-map');
	if($googleMap.length > 0) {
		$googleMap.each(function(){
			var mapHeight = $(this).data('height'),
					address = $(this).data('address'),
					zoom = $(this).data('zoom'),
					controls = $(this).data('disable-controls'),
					scrollwheel = $(this).data('scrollwheel'),
					marker = $(this).data('marker'),
					markerTitle = $(this).data('marker-title'),
					styles = $(this).data('styles');
			$(this).height(mapHeight);
			$(this).gmap3({
          marker:{
            address: address,
            data: markerTitle,
            options: {
            	icon: marker
            },
            events: {
              mouseover: function(marker, event, context){
                var map = $(this).gmap3("get"),
                  	infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  $(this).gmap3({
                    infowindow:{
                      anchor:marker,
                      options:{content: context.data}
                    }
                  });
                }
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              }
            }
          },
          map:{
            options:{
              zoom: zoom,
              disableDefaultUI: controls,
              scrollwheel: scrollwheel,
              styles: styles
            }
          }
			});
		});
	}
	
});/*Document Ready End*/
