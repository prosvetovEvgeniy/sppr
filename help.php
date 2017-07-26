<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Nucleus | Help Center Topic</title>

  <!--SEO Meta Tags-->
  <meta name="description" content="Nucleus Multi-Purpose Technology Template" />
  <meta name="keywords" content="multipurpose, technology, business, corporate, hosting, web, startup, app showcase, mobile, blog, portfolio, landing, shortcodes, html5, css3, jquery, js, gallery, slider, touch, creative" />
  <meta name="author" content="8Guild" />

  <!--Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!--Favicon-->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- All Theme Styles including Bootstrap, FontAwesome, etc. compiled from styles.scss-->
  <link href="design/css/styles.css" rel="stylesheet" media="screen">

  <!--Modernizr / Detectizr-->
  <script src="design/js/vendor/modernizr.custom.js"></script>
  <script src="design/js/vendor/detectizr.min.js"></script>
</head>

<!-- Body -->
<!-- "is-preloader preloading" is a helper classes if preloader is enabled. -->
<body class="<?php echo $config['preloader'];?>">
  
  <!-- Preloader -->
  <!-- 
      Data API:
      data-spinner - Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
      data-screenbg - Screen background color. Hex, RGB or RGBA colors
   -->
  <div id="preloader" data-spinner="<?php echo $config['preloader_spinner'];?>" data-screenbg="#fff"></div>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

	<?php include "includes/header.php" ?>
    <!-- Page Title -->
    <!--Add modifier class : "pt-fullwidth" to stretch page title and make it occupy 100% of the page width. -->
    <section class="page-title">
      <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Справка</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            
          </div><!-- .column -->
        </div>
      </div>
    </section><!-- .page-title -->

    <!-- Container -->
    <div class="container padding-bottom">

      <!-- Help Search -->
      

      <div class="row padding-top">

        <!-- Content -->
		
		<?php 
		if($_GET['name'] == 'mah')
		{
		?>
        <div class="col-lg-8 col-md-8 col-lg-offset-1 col-lg-push-3 col-md-push-4">
          <h2 class="block-title">
            Метод анализа иерархий
            <small>Метод анализа иерархий: характеристика метода</small>
          </h2>
          <img src="design/img/help/mah/mah2.png" class="space-bottom img-center" alt="Image">
          <p class="padding-top">В 70-80-е годы американский учёный Т.Л. Саати разработал и развил "иерархический аналитический процесс" (analytic hierarchy process, AHP) – мощный метод сопоставительного анализа и ранжирования объектов, характеризующихся наборами критериев и показателей, количественных и качественных. В литературе этот метод называют также методом анализа иерархий (МАИ). Метод применяется для многих задач. Вот основные:</p>
          <ol>
            <li>Сравнительный анализ объектов (многокритериальное ранжирование).</li>
            <li>Многокритериальный выбор лучшего объекта (лучшей альтернативы).</li>
            <li>Распределение ресурсов между проектами.</li>
			<li>Проектирование систем по количественным и качественным характеристикам.</li>
          </ol>
		  <p class="">Этот метод для успешного применения требует соблюдения следующих условий:</p>
		  <ul class="list-featured">
            <li>В процедуре принимают участие достаточно квалифицированные эксперты, не допускающие существенных погрешностей в оценках, более того, в МАИ требуется, чтобы группа экспертов была консолидированной, т.е. имеющей общие позиции и стремящейся к согласованности своих оценок;</li>
            <li>Для множества сравниваемых объектов ("альтернатив") может быть выстроена общая система критериев;</li>
            <li>Оценки по "негативным" критериям не находятся в опасной близости к ограничениям.</li>
          </ul>
		  <br>
		  
		  <h3 class="block-title">
            Метод анализа иерархий: алгоритм
            <small>Шаги метода анализа иерархий</small>
          </h3>
		  <h6 class="">
            1.Представление исходной проблемы в виде иерархической структуры (рис. 1).
          </h6>
		  <p class="padding-bottom">Цель составляет высший уровень иерархии (уровень 1). На этом уровне может находиться лишь один объект. На следующих вниз уровнях находятся критерии. По системе этих критериев оцениваются сравниваемые объекты (называемые «альтернативами»). Альтернативы располагаются на самом нижнем уровне. В задаче могут присутствовать несколько уровней критериев, но обычно применяют иерархии 3- уровневые (цель – критерии – альтернативы) и 4-х уровневые (цель – комплексные критерии – критерии – альтернативы).</p>
		  
		  <img src="design/img/help/mah/pic1.jpg" class="img-center" alt="Image">
		  <p class="text-center bold-font-pic padding-top">Рис 1. - Трёхуровневая иерархия «цель – критерии – альтернативы» </p>
        
		  <h6 class="padding-top">
            2.Вынесение экспертных суждений на каждом уровне иерархии по парным сравнениям:
          </h6>
		  
		  <p class="padding-bottom">Критерии сравниваются попарно по отношению к цели, альтернативы – попарно по отношению к каждому из критериев. Соответственно заполняются матрицы парных сравнений (таб. 1): одна – для критериев, n матриц – для альтернатив; здесь n – количество критериев.</p>
		
		  <img src="design/img/help/mah/tab1.jpg" style="border:1px solid;" class="img-center" alt="Image">
		  <p class="text-center bold-font-pic padding-top">Таблица 1. - Матрица парных сравнений </p>
		  
		  <p class="padding-top"><b>Операция парного сравнения:</b> два объекта, находящихся на одном уровне сравниваются по своей относительной значимости для одного объекта высшего уровня. Если критерий имеет определенную числовую меру, например, масса, производительность, цена, то в качестве результата оценки удобно взять отношения соответствующих характеристик (заданных, или рассчитанных) в некоторой шкале отношений. Если критерий не имеет принятой меры, то сравнение в МАИ проводится с использованием специальной «шкалы относительной важности» (другие названия: «шкала 1-9», «шкала Саати»). Эта шкала имеет 9 степеней предпочтения, выбранные с учетом экспериментально установленных психофизиологических особенностей человека, выполняющего сравнение (таб. 2).</p>
		  <p class="text-center bold-font-pic padding-top">Таблица 2. - Шкала Саати </p>
		  <div class="table-responsive">
			<table>
			  <thead>
				<tr>
				  <th>Степень предпочтения </th>
				  <th>Определение</th>
				  <th>Комментарии</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">1</th>
				  <td>Равная предпочтительность</td>
				  <td>Две альтернативы одинаково предпочтительны с точки зрения цели </td>
				</tr>
				<tr>
				  <th scope="row">2</th>
				  <td>Слабая степень предпочтения </td>
				  <td>Промежуточная градация между равным и средним предпочтением</td>
				</tr>
				<tr>
				  <th scope="row">3</th>
				  <td>Средняя степень предпочтения</td>
				  <td>Опыт эксперта позволяет считать одну из альтернатив немного предпочтительнее другой</td>
				</tr>
				<tr>
				  <th scope="row">4</th>
				  <td>Предпочтение выше среднего</td>
				  <td>Промежуточная градация между средним и умеренно сильным предпочтением </td>
				</tr>
				<tr>
				  <th scope="row">5</th>
				  <td>Умеренно сильное предпочтение</td>
				  <td>Опыт эксперта позволяет считать одну из альтернатив явно предпочтительнее другой</td>
				</tr>
				<tr>
				  <th scope="row">6</th>
				  <td>Сильное предпочтение</td>
				  <td>Промежуточная градация между умеренно сильным и очень сильным предпочтением </td>
				</tr>
				<tr>
				  <th scope="row">7</th>
				  <td>Очень сильное(очевидное) предпочтение</td>
				  <td>Опыт эксперта позволяет считать одну из альтернатив гораздо предпочтительнее другой: доминирование альтернативы подтверждено практикой </td>
				</tr>
				<tr>
				  <th scope="row">8</th>
				  <td>Очень, очень сильное предпочтение</td>
				  <td>Промежуточная градация между очень сильным и абсолютным предпочтением </td>
				</tr>
				<tr>
				  <th scope="row">9</th>
				  <td>Абсолютное предпочтение</td>
				  <td>Очевидность подавляющей предпочтительности одной альтернативы над другой имеет неоспоримое подтверждение </td>
				</tr>
			  </tbody>
			</table>
		</div>
		
		<p class="padding-top">При операции парного сравнения используют значения обратных оценок предпочтения: если преимущество i-той альтернативы по сравнению с j-той имеет одно из приведенных выше значений, то оценка предпочтения i-той альтернативы над j-той будет иметь обратное значение. То есть в МАИ все матрицы парных сравнений (МПС) являются обратно симметричными. </p>
		
		<h6 class="">
           3.Математическая обработка матриц парных сравнений для нахождения локальных и глобальных приоритетов.
        </h6>
		<p class="padding-bottom">При точном процессе определения вектора локальных приоритетов задача сводится к нахождению собственного вектора матрицы парных сравнений:</p>
		<img src="design/img/help/mah/pic2.jpg" class="img-center" alt="Image">
		
		<p class="padding-bottom">где A – матрица парных сравнений (МПС), X – n-мерный вектор, составленный из искомых приоритетов, λ - собственное значение МПС;и последующего нормирования этого вектора:</p>
		<img src="design/img/help/mah/pic3.jpg" class="img-center" alt="Image">
		
		<p class="padding-bottom padding-top">В рассматриваемой задаче искомым является вектор, соответствующий максимальному собственному значению. Вектор локальных приоритетов может быть приближенно вычислен упрощенным способом:</p>
		<ol>
            <li>Для каждой строки матрицы парных сравнений находим среднее геометрическое ее элементов: <img src="design/img/help/mah/pic4.png" class="img-center" alt="Image"></li>
            <li>Находим сумму всех этих средних геометрических.</li>
            <li>Делим каждое среднее геометрическое на их сумму(«нормировка на единицу»). Результат - вектор локальных приоритетов данной матрицы.</li>
        </ol>
		<p class="padding-bottom padding-top"> В МАИ есть возможность проверки согласованности экспертных оценок, т.е. чисел в каждой матрице парных сравнений. Для контроля согласованности этих оценок вводятся две связанные характеристики - индекс согласованности (CI) и отношение согласованности (CR):</p>
		<img src="design/img/help/mah/pic5.png" class="img-center" alt="Image">
		<img src="design/img/help/mah/pic6.png" class="img-center" alt="Image">
		
		<p class="padding-bottom">где Pn – это индекс согласованности для положительной обратно симметричной матрицы случайных оценок размера [N x N]; элементы этой матрицы получены случайным выбором из множества допустимых оценок, т.е. из чисел ряда {1/9, 1/8, 1/7, 1/6, 1/5, 1/4, 1/3, 1/2, 1, 2, 3, 4, 5, 6, 7, 8, 9}.</p>
		<p class="text-center bold-font-pic">Таблица 3. - Значения индекса согласованности </p>
		<div class="table-responsive">
			<table>
			  <thead>
				<tr>
				  <th>N</th>
				  <th>1</th>
				  <th>2</th>
				  <th>3</th>
				  <th>4</th>
				  <th>5</th>
				  <th>6</th>
				  <th>7</th>
				  <th>8</th>
				  <th>9</th>
				  <th>10</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">Pn</th>
				  <td>0</td>
				  <td>0</td>
				  <td>0.58</td>
				  <td>0.90</td>
				  <td>1.12</td>
				  <td>1.24</td>
				  <td>1.32</td>
				  <td>1.41</td>
				  <td>1.45</td>
				  <td>1.49</td>
				</tr>
			  </tbody>
			</table>
		</div>
		
		<p class="">Допустимым считается отношение согласованности (CR), не превышающее 10 - 20%. Если CR выходит из этих пределов, то экспертам необходимо исследовать задачу и проверить свои оценки. </p>
		
		<p class="">В результате обработки матриц получаем один вектор локальных приоритетов критериев размерности m (m - число критериев) и m векторов локальных приоритетов альтернатив размерности n (n - число альтернатив). Вектор локальных приоритетов критериев показывает их относительную значимость в задаче.</p>
		
		<p class="">Вектор глобальных приоритетов альтернатив по отношению к цели вычисляется так: каждый компонент этого m-вектора – это скалярное произведение вектора локальных приоритетов критериев на m-вектор, составленный из локальных приоритетов альтернативы по данным критериям («профиль альтернативы»).</p>
		
		<p class="">Профили дают в относительном виде достоинства и недостатки каждой из альтернатив и могут использоваться для определения путей улучшения альтернативы, например, для повышения конкурентоспособности.</p>
		
		<p class="padding-bottom">Вектор глобальных приоритетов – это и есть решение задачи многокритериального ранжирования. На основании его можно, например, решить задачу выбора: альтернатива с максимальным значением глобального приоритета является лучшей по совокупности критериев с учётом относительной важности последних.</p>
		
		
		<h3 class="block-title">
            Метод анализа иерархий в СППР Nucleus
        </h3>
		<p class="padding-bottom">В СППР Nucleus методом анализа иерархий можно решить многокритериальную задачу, структура которой представлена в виде трёхуровневой иерархии (см. рис. 1). В следующем релизе будет добавлена возможность решения задачи с четырёхуровневой иерархией.</p>
		
		<h4 class="block-title">
            Входные данные:
        </h4>
		
		<ul class="list-featured">
            <li><b>Цель –</b> краткое описание задачи; составляет первый уровень иерархии. В МАИ цель чаще всего начинается словами: выбрать, ранжировать, найти и т. п. Например, выбор специальности, ранжировать студентов, найти лучший вариант работы. Максимальная длина – 80 символов.</li>
            <li><b>Критерии –</b> количественная или качественная характеристика, существенная для суждения об объекте; составляют второй уровень иерархии. В СППР Nucleus можно задавать от 2 до 10 критериев, причиной такого ограничения является то, что МАИ адекватно работает только с небольшим количеством критериев. Максимальная длина наименования критерия – 20 символов.</li>
            <li><b>Альтернативы –</b> объекты, среди которых необходимо сделать выбор; составляют третий уровень иерархии. В СППР Nucleus можно задавать от 2 до 10 альтернатив, т.к. МАИ адекватно работает также и с небольшим количеством альтернатив. Максимальная длина наименования альтернативы – 20 символов.</li>
        </ul>
		
		<h4 class="block-title">
            Пример решения задачи
        </h4>
		<h5 class="block-title">
            1. Постановка задачи
        </h5>
		
		<p class="padding-bottom">Постановка задачи метода анализа иерархий осуществляется на странице «Ввод данных». Здесь необходимо задать входные данные, иначе переход к следующей странице не станет возможным – кнопка «Построить матрицу сравнений» становится активной лишь после заполнения всех полей.</p>
		
		<img src="design/img/help/mah/pic7.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 2. - Пример заполнения страницы «Ввод данных» </p>
		
		<p class="padding-bottom">После нажатия кнопки «Построить матрицу сравнений» происходит переход к странице «Решение».</p>
		
		<h5 class="block-title">
            2. Решение задачи
        </h5>
		<p class=""><b>Заполнение МПС</b> </p>
		
		<p class="">Для заполнения МПС можно использовать шкалу Саати, если объекты сравниваются относительно качественной характеристики (например, удобство, состояние и т. п.).</p>
		
		<p class="">На этой странице для активации кнопки «Далее» необходимо заполнить корректно все необходимые поля таблицы – те поля, что НЕ помечены «‒» и нажать кнопку Далее.</p>
		<p class="">После этого, если поля МПС были заполнены корректно, происходит вычисление локальных приоритетов и заполнение таблицы индексов.</p>
		<p class="">Опишем показатели этой таблицы:</p>
		<ul class="list-featured">
            <li><b>DIM</b> – размер МПС;</li>
            <li><b>Lam</b> – максимальное собственное значение МПС;</li>
            <li><b>CI</b> – индекс согласованности МПС;</li>
			<li><b>CR</b> – отношение согласованности МПС.</li>
          </ul>
		<p class="">Первые три показателя используются для нахождения последнего (CR), который показывает, насколько согласованы суждения об объектах. Значение CR считается допустимым, если не превышает 0.10-0.20. Иначе – рекомендуется пересмотреть оценки.</p>
		<p class="">На первой части страницы «Решение» – «ШАГ 2» необходимо сравнить заданные критерии относительно цели. Чаще всего, для этого используют шкалу Саати.</p>
		
		<img src="design/img/help/mah/pic8.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 3. - Пример заполнения страницы «Решение: ШАГ2.»</p>
		
		<p class="">После нажатия кнопки «Далее» происходит переход к следующей части страницы «Решение: ШАГ 3».</p>
		<p class="">На «ШАГ3» необходимо сравнить заданные альтернативы относительно каждого заданного критерия</p>
		
		<img src="design/img/help/mah/pic9.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 4. - Пример заполнения матрицы относительно критерия "Размер"</p>
		
		<p class=""> </p>
		<p class="">После нажатия кнопки «Далее» происходит переход к следующей части страницы</p>
		
		<img src="design/img/help/mah/pic10.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 5. - Пример заполнения матрицы относительно критерия "Транспорт"</p>
		
		<p class="">После нажатия кнопки «Далее» происходит переход к следующей части страницы</p>
		
		<img src="design/img/help/mah/pic11.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 6. - Пример заполнения матрицы относительно критерия "Состояние"</p>
		
		<p class="">После нажатия кнопки «Далее» происходит переход к следующей части страницы</p>
		
		<img src="design/img/help/mah/pic12.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 7. - Пример заполнения матрицы относительно критерия "Стоимость"</p>
		<br>
		<h5 class="block-title">
            3. Результат
        </h5>
		<p class="">Результат решения задачи методом анализа иерархий представлен на странице «Результат», где находится таблица с ранжированными глобальными приоритетами альтернатив, также для наглядности на странице «Результат» имеется диаграмма</p>
		<p class="">Альтернатива с наибольшим значением глобального приоритета является лучшей для данной цели.</p>
		
		<img src="design/img/help/mah/pic13.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 8. - Часть страницы с результатом</p>
		
		</div><!-- .col-lg-8.col-md-8.col-lg-offset-1.col-lg-push-3.col-md-push-4 -->
		
		<?php
		}
		else if($_GET['name'] == 'matrix_method')
		{
		?>
		
		<div class="col-lg-8 col-md-8 col-lg-offset-1 col-lg-push-3 col-md-push-4">
          <h2 class="block-title">
            Принятие решений в условиях неопределенности
            <small>характеристика метода</small>
          </h2>
          <img src="design/img/help/matrixMethod/matr2.png" class="space-bottom img-center" alt="Image">
          
		  <p class="padding-top">В зависимости от степени неизвестности предстоящего поведения исходных параметров принятия решений различают условия риска, в которых вероятность наступления отдельных событий, влияющих на конечный результат, может быть установлена с той или иной степенью точности, и условия неопределенности, в которых из-за отсутствия необходимой информации такая вероятность не может быть установлена. Теория принятия решений в условиях риска и неопределенности основывается на следующих исходных положениях:</p>
          <ol>
            <li>Объект принятия решения четко детерминирован и по нему известны основные из возможных факторов риска. В финансовом менеджменте такими объектами выступают отдельная финансовая операция, конкретный вид ценных бумаг, группа взаимоисключающих реальных инвестиционных проектов и т.п</li>
            <li>По объекту принятия решения избран показатель, который наилучшим образом характеризует эффективность этого решения. По краткосрочным финансовым операциям таким показателем избирается обычно сумма или уровень чистой прибыли, а по долгосрочным — чистый приведенный доход или внутренняя ставка доходности.</li>
            <li>По объекту принятия решения избран показатель, характеризующий уровень его риска. Финансовый риск характеризуются обычно степенью возможного отклонения ожидаемого показателя эффективности (чистой прибыли, чистого приведенного дохода и т.п.) от средней или ожидаемой его величины.</li>
			<li>Имеется конечное количество альтернатив принятия решения (конечное количество альтернативных реальных инвестиционных проектов, конкретных ценных бумаг, способов осуществления определенной финансовой операции и т.п.)</li>
			<li>Имеется конечное число ситуаций развития события под влиянием изменения факторов риска. В финансовом менеджменте каждая из таких ситуаций характеризует одно из возможных предстоящих состояний внешней финансовой среды под влиянием изменений отдельных факторов риска. Число таких ситуаций в процессе принятия решений должно быть детерминировано в диапазоне от крайне благоприятных (наиболее оптимистическая ситуация) до крайне неблагоприятных (наиболее пессимистическая ситуация).</li>
			<li>По каждому сочетанию альтернатив принятия решений и ситуаций развития события может быть определен конечный показатель эффективности решения (конкретное значение суммы чистой прибыли, чистого приведенного дохода и т.п., соответствующее данному сочетанию).</li>
			<li>По каждой из рассматриваемой ситуации возможна или невозможна оценка вероятности ее реализации. Возможность осуществления оценки вероятности разделяет всю систему принимаемых рисковых решений на ранее рассмотренные условия их обоснования («условия риска» или «условия неопределенности»).</li>
			<li>Выбор решения осуществляется по наилучшей из рассматриваемых альтернатив.</li>
          </ol>
		  <br>
		  
		  <h3 class="block-title">
            Методология
          </h3>
		 
		  <p class="padding-top"><b>Принятие решений в условиях неопределенности</b> основано на том, что вероятности различных вариантов ситуаций развития событий субъекту, принимающему рисковое решение, неизвестны. В этом случае при выборе альтернативы принимаемого решения субъект руководствуется, с одной стороны, своим рисковым предпочтением, а с другой — соответствующим критерием выбора из всех альтернатив по составленной им «матрице решений».</p>
		  <p class="padding-top">Основные критерии, используемые в процессе принятия решений в условиях неопределенности, представлены ниже:</p>
		  
		  <ol>
			<li>Критерий Вальда</li>
			<li>Критерий Лапласа</li>
			<li>Критерий Гурвица</li>
			<li>Критерий Сэвиджа</li>
		  </ol>
		  
		  <h6 class="padding-top">
            1.Критерий Вальда (или критерий «максимина»)
          </h6>
		  <p class=""> </p>
		  <p class="padding-top">Критерий Вальда,предполагает, что из всех возможных вариантов «матрицы решений» выбирается та альтернатива, которая из всех самых неблагоприятных ситуаций развития события (минимизирующих значение эффективности) имеет наибольшее из минимальных значений (т.е. значение эффективности, лучшее из всех худших или максимальное из всех минимальных).</p>
		  <p class="">Критерием Вальда (критерием «максимина») руководствуется при выборе рисковых решений в условиях неопределенности, как правило, субъект, не склонный к риску или рассматривающий возможные ситуации как пессимист.</p>
		  
		  
		  <h6 class="padding-top">
            2.Критерий Лапласа (или критерий максимакса)
          </h6>
		  <p class="">Критерий Лапласа, предполагает, что из всех возможных вариантов «матрицы решений» выбирается та альтернатива, которая из всех самых благоприятных ситуаций развития событий (максимизирующих значение эффективности) имеет наибольшее из максимальных значений (т.е. значение эффективности лучшее из всех лучших или максимальное из максимальных).</p>
		  <p class="">Критерий Лапласа используют при выборе рисковых решений в условиях неопределенности, как правило, субъекты, склонные к риску, или рассматривающие возможные ситуации как оптимисты.</p>
		  
		  <h6 class="padding-top">
            3.Критерий Гурвица (критерий «оптимизма-пессимизма» или «альфа-критерий»)
          </h6>
		  <p class="">Критерий Гурвица, позволяет руководствоваться при выборе рискового решения в условиях неопределенности некоторым средним результатом эффективности, находящимся в поле между значениями по критериям «максимакса» и «максимина» (поле между этими значениями связано посредством выпуклой линейной функции). Оптимальная альтернатива решения по критерию Гурвица определяется на основе следующей формулы:</p>
		  <img src="design/img/help/matrixMethod/gur.png" class="" alt="Image">
		  
		  <h6 class="padding-top">
            4.Критерий Сэвиджа (критерий потерь от «минимакса»)
          </h6>
		  <p class="">Критерий Сэвиджа, предполагает, что из всех возможных вариантов «матрицы решений» выбирается та альтернатива, которая минимизирует размеры максимальных потерь по каждому из возможных решений. При использовании этого критерия «матрица решения» преобразуется в «матрицу потерь» (один из вариантов «матрицы риска»), в которой вместо значений эффективности проставляются размеры потерь при различных вариантах развития событий.</p>
		  <p class="">Критерий Сэвиджа используется при выборе рисковых решений в условиях неопределенности, как правило, субъектами, не склонными к риску.</p>
		  
		  
		  <h3 class="block-title">
            Принятие решений в условиях неопределенности в СППР Nucleus
          </h3>
		  
		  <h4 class="block-title">
            Входные данные:
		  </h4>
		
		  <ul class="list-featured">
            <li><b>Цель –</b> краткое описание задачи; составляет первый уровень иерархии. В МАИ цель чаще всего начинается словами: выбрать, ранжировать, найти и т. п. Например, выбор специальности, ранжировать студентов, найти лучший вариант работы. Максимальная длина – 80 символов.</li>
            <li><b>Внешние условия – </b> условия, которые могут оказывать влияние на среду</li>
            <li><b>Альтернативы –</b> объекты, среди которых необходимо сделать выбор; составляют третий уровень иерархии. В СППР Nucleus можно задавать от 2 до 10 альтернатив, т.к. МАИ адекватно работает также и с небольшим количеством альтернатив. Максимальная длина наименования альтернативы – 20 символов.</li>
          </ul>
		  
		 
		
		<h4 class="block-title">
            Пример решения задачи
        </h4>
		<h5 class="block-title">
            1. Постановка задачи
        </h5>
		
		
		
		<p class=""> Пример: необходимо выбрать проект электростанции. Возможно 4 варианта:  A1 – ТЭЦ,   A2 – ГЭС, A3 – АЭС,  A4 – ПЭС. Состояния среды, влияющие на строительство и дальнейшую эксплуатацию, учитывает следующие факторы: погода, возможность навод-нения, цена топлива, расходы на его транспортировку. Пусть выделено 4 варианта ком-бинаций факторов: B1, B2, B3, B4 . В матрице выигрышей показана эффективность каждого из вариантов: </p>
		
		<img src="design/img/help/matrixMethod/pic1.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 1. - Пример заполнения страницы «Ввод данных» </p>
		
		<p class="padding-bottom">После нажатия кнопки «Построить матрицу полезности» происходит переход к странице «Решение».</p>
		
		
		<h5 class="block-title">
            2. Решение задачи
        </h5>
		<p class=""><b>Заполнение Матрицы полезности</b> </p>
		
		<p class="">Матрица полезности может заполнятся как дробными так и целыми числами(рис 2). После полного заполнения матрицы полезности следует нажать кнопку "Выбрать правила ММР"</p>
		
		
		<img src="design/img/help/matrixMethod/pic2.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 2. - Пример заполнения "Матрицы полезности"</p>
		<br>
		<br>
		<p class=""><b>Выбор правил решения задачи</b> </p>
		
		<p class="">В нашем тестовом примере мы выберем все 4 доступных метода(рис 3). Также при выборе оптимального варианта по гурвицу следует указать Альфа(степень доверия). </p>
		
		<img src="design/img/help/matrixMethod/pic3.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 3. - Пример выбора правил решения задачи"</p>
		
		<br>
		<br>
		<p class=""><b>Результат</b> </p>
		<p class="">В таблице "Результат" указаны правила, по которым расчитывались оптимальные альтернативы и собственно сами эти альтернативы.(рис 4) </p>
		<img src="design/img/help/matrixMethod/pic4.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 4. - Результат вычислений</p>
		
		
		</div><!-- .col-lg-8.col-md-8.col-lg-offset-1.col-lg-push-3.col-md-push-4 -->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<?php 
		}
		else if($_GET['name'] == 'risk_method')
		{
		?>
		<div class="col-lg-8 col-md-8 col-lg-offset-1 col-lg-push-3 col-md-push-4">
          <h2 class="block-title">
            Принятие решений в условиях риска
            <small>характеристика метода</small>
          </h2>
          <img src="design/img/help/riskMethod/risk2.png" class="space-bottom img-center" alt="Image">
		
		<p class="padding-top">Основано на том, что каждой возможной ситуации развития событий может быть задана определенная вероятность его осуществления. Это позволяет взвесить каждое из конкретных значений эффективности по отдельным альтернативам на значение вероятности и получить на этой основе интегральный показатель уровня риска, соответствующий каждой из альтернатив принятия решений. Сравнение этого интегрального показателя по отдельным альтернативам позволяет избрать для реализации ту из них, которая приводит к избранной цели (заданному показателю эффективности) с наименьшим уровнем риска.</p>
		<p>Оценка вероятности реализации отдельных ситуаций развития событий может быть получена экспертным путем.</p>
		<p>Исходя из матрицы решений, построенной в условиях риска с учетом вероятности реализации отдельных ситуаций, рассчитывается интегральный уровень риска по каждой из альтернатив принятия решений.</p>
		
		<h3 class="block-title">
            Принятие решений в условиях риска в СППР Nucleus
        </h3>
		  
		<h4 class="block-title">
            Входные данные:
		</h4>
		
		<ul class="list-featured">
            <li><b>Цель –</b> краткое описание задачи; составляет первый уровень иерархии. В МАИ цель чаще всего начинается словами: выбрать, ранжировать, найти и т. п. Например, выбор специальности, ранжировать студентов, найти лучший вариант работы. Максимальная длина – 80 символов.</li>
            <li><b>Варианты внешние условия – </b> условия, которые могут оказывать влияние на среду</li>
            <li><b>Альтернативы –</b> объекты, среди которых необходимо сделать выбор; составляют третий уровень иерархии. В СППР Nucleus можно задавать от 2 до 10 альтернатив, т.к. МАИ адекватно работает также и с небольшим количеством альтернатив. Максимальная длина наименования альтернативы – 20 символов.</li>
		</ul>
		
		<h4 class="block-title">
            Пример решения задачи
        </h4>
		<h5 class="block-title">
            1. Постановка задачи
        </h5>
		
		
		<p class=""> Пример: выбор варианта производимого товара. </p>
		<p class="">Фирма может выпускать продукцию одного из следующих типов: зонты (З), куртки (К), плащи (П), сумки (С), шляпы (Ш), туфли (Т). Глава фирмы должен решить, какую продукцию выпускать предстоящим летом. Прибыль фирмы зависит от того, каким будет лето: дождливым (Д), жарким (Ж) или умеренным (У).(рис 1)</p>
		
		<img src="design/img/help/riskMethod/pic1.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 1. - Пример заполнения страницы «Ввод данных» </p>
		
		<br><br>
		<h5 class="block-title">
            2. Решение задачи
        </h5>
		<p class=""><b>Заполнение Матрицы полезности</b> </p>
		
		<p class="">Матрица полезности может заполнятся как дробными так и целыми числами(рис 2). После полного заполнения матрицы полезности следует нажать кнопку "Рассчитать". Сумма вероятностей всегда должна равняться 1.</p>
		
		<img src="design/img/help/riskMethod/pic2.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 2. - Пример заполнения "Матрицы полезности" </p>
		
		<br><br>
		<h5 class="block-title">
            2. Результат
        </h5>
		
		<p> После расчета будет представлено 3 таблицы(рис 3). В первой таблице содержится лучшая альтернатива при высоком риске, во второй таблице представлена альтернатива при усредненном значении, а в 3 таблице показана лучшая альтернатива при низком уровне риска</p>
		
		<img src="design/img/help/riskMethod/pic3.png" class="img-center" alt="Image">
		<p class="text-center bold-font-pic padding-top">Рис 3. - Результат вычислений</p>
		</div>
		
		<?php
		}
		else if($_GET['name'] == 'literature')
		{
		?>
		<div class="col-lg-8 col-md-8 col-lg-offset-1 col-lg-push-3 col-md-push-4">
		<h3 class="block-title">
            Книги по МКА и СППР
        </h3>
		
		<ol>
            <li>Ларичев О.И. Наука и искусство принятия решений. М.: Наука, 1979. – 200 с.</li>
            <li>Ларичев О.И. Объективные модели и субъективные решения. М.: Наука, 1987.</li>
			<li>Мушик Э., Мюллер П. Методы принятия технических решений. – М.: Мир, 1990. – 208 с.</li>
			<li>Тоценко В.Г. Методы и системы поддержки принятия решений. – Киев: Наукова думка, 2002. – 382 с.</li>
			<li>Саати Т.Л. Принятие решений при зависимостях и обратных связях: Аналитические сети. – М.: Изд-во ЛКИ, 2008. – 360 с.</li>
			<li>Микони С.В. Многокритериальный выбор на конечном множестве альтернатив: Учебное пособие. – СПб.: Издательство "Лань", 2009. - 272 с: ил.</li>
			<li>Юдин Д.Б. Вычислительные методы теории принятия решений. Изд. 2-е. – М.: КРАСАНД, 2010. – 320 с. (УРСС)</li>
			<li>Ширяев А.Н. Вероятностно-статистические методы в теории принятия решений. – М.: ФМОП, МЦНМО, 2011. – 144 с. (Яндекс)</li>
          </ol>
		  </div>
		<?php }?>
		
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 col-lg-pull-9 col-md-pull-8">
          <div class="space-top-3x visible-sm visible-xs"></div>
          <aside class="sidebar space-bottom-2x">
            <section class="widget widget_categories">
              <h3 class="widget-title">
                <i class="icon-ribbon"></i>
                СППР....
              </h3>
              <ul>
			  <?php 
				$methods = mysqli_query($connection, "SELECT * FROM `methods` ORDER BY `id`");
				while($method = mysqli_fetch_assoc($methods)){
			  ?>
                <li><a href="/help.php?name=<?php echo $method['filter_ref']; ?>"><?php echo $method['methodName']; ?> </a></li>
			  <?php } ?>
                <li><a href="/help.php?name=literature">Литература</a></li>
              </ul>
            </section><!-- .widget.widget_categories -->
          </aside><!-- .sidebar -->
          
        </div>
      </div><!-- .row -->

      <!-- Topics -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

  </div><!-- .page-wrapper -->

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts -->
  <?php include "includes/scripts.php" ?>

</body><!-- <body> -->

</html>