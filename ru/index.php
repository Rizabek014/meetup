<?php
    $GLOBALS['filename'] = 'index';

    include ('Database.php');
    include ('nav.php');

    $is_logged_in = isset($_COOKIE["type"]);

    $meetup = mysqli_query($db, "SELECT * FROM meetups");
    $image = mysqli_query($db, "SELECT * FROM image");
?>

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">Найди свой<br><span>Meetup</span> у нас</h1>
      <p class="mb-4 pb-0">Присоединяйтесь К Нашим Замечательным Встречам и Развивайтесь</p>
      <a href="https://www.youtube.com/watch?v=KaQoj4mmY5E" class="venobox play-btn mb-4" data-vbtype="video"
        data-autoplay="true"></a>
      <a href="#about" class="about-btn scrollto">О Мероприятии</a>
    </div>
  </section>

  <main id="main">
    <!--==========================
      About Section
    ============================-->

    <!--==========================
      Speakers Section
    ============================-->
    <section id="speakers" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Исследуй Meetup'ы</h2>
          <p>Некоторые из наших мероприятий</p>
        </div>

          <div class="row">
              <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                      <img src="../img/speakers/2.jpg" alt="Speaker 2" class="img-fluid">
                      <div class="details">
                          <h3><a href="speaker-details.html">Meetup name</a></h3>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                      <img src="../img/speakers/3.jpg" alt="Speaker 3" class="img-fluid">
                      <div class="details">
                          <h3><a href="speaker-details.html">Meetup name</a></h3>
                          <p>Meetup Location</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                      <img src="../img/speakers/4.jpg" alt="Speaker 4" class="img-fluid">
                      <div class="details">
                          <h3><a href="speaker-details.html">Meetup name</a></h3>
                          <p>Meetup Location</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                      <img src="../img/speakers/5.jpg" alt="Speaker 5" class="img-fluid">
                      <div class="details">
                          <h3><a href="speaker-details.html">Meetup name</a></h3>
                          <p>Meetup Location</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                      <img src="../img/speakers/6.jpg" alt="Speaker 6" class="img-fluid">
                      <div class="details">
                          <h3><a href="speaker-details.html">Meetup name</a></h3>
                          <p>Meetup Location</p>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </section>


    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery" class="section-with-bg wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Проверьте нашу галерею из последних событий</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
        <a href="../img/gallery/1.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/1.jpg" alt=""></a>
        <a href="../img/gallery/2.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/2.jpg" alt=""></a>
        <a href="../img/gallery/3.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/3.jpg" alt=""></a>
        <a href="../img/gallery/4.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/4.jpg" alt=""></a>
        <a href="../img/gallery/5.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/5.jpg" alt=""></a>
        <a href="../img/gallery/6.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/6.jpg" alt=""></a>
        <a href="../img/gallery/7.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/7.jpg" alt=""></a>
        <a href="../img/gallery/8.jpg" class="venobox" data-gall="gallery-carousel"><img src="../img/gallery/8.jpg" alt=""></a>
      </div>

    </section>


    <!--==========================
      F.A.Q Section
    ============================-->
    <section id="faq" class="wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>F.A.Q </h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-9">
              <ul id="faq-list">

                <li>
                  <a data-toggle="collapse" class="collapsed" href="#faq1"> Как рабоатет Meetup ? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq1" class="collapse" data-parent="#faq-list">
                    <p>
                        Откройте свою группу.
                        Посмотрите, кто проводит местные мероприятия для всего, что вы любите.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq2" class="collapsed">Как создать Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq2" class="collapse" data-parent="#faq-list">
                    <p>
                        Прежде всего, вы должны зарегистрироваться. Затем нажмите кнопку" Создать Meetup". Наконец, вы должны ждать одобрения.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq3" class="collapsed">Почему вы должны участвовать в Meetups? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq3" class="collapse" data-parent="#faq-list">
                    <p>
                      У всех, кто участвует, будут похожие интересы<br>
                      Это отличный способ познакомиться с новыми людьми<br>
                      Вы получите идеи и вдохновение от спикеров и других участников<br>
                      Вы обязательно найдете советы, которые можно реализовать в собственном бизнесе<br>
                      Обсуждая то, с чем вы боретесь, вы можете найти некоторые полезные советы<br>
                      Это возможность провести время в реальном мире, от вашего ноутбука…
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq4" class="collapsed"> Что такое Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq4" class="collapse" data-parent="#faq-list">
                    <p>
                        Meetups развивались в течение последних нескольких лет как способ для людей, которые имеют общий интерес, часто встречаясь и общаясь через Интернет, чтобы собраться вместе в реальной жизни. Meetups может принимать множество форм, но они, как правило, довольно неформальные и часто веселые.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq5" class="collapsed">Почему я не могу найти мой новый Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq5" class="collapse" data-parent="#faq-list">
                    <p>
                        Когда вы впервые создаете новый Meetup, наша команда проверяет его на содержание. Мы хотим убедиться, что он соответствует нашим рекомендациям Meetup и другим стандартам, которые у нас есть для meetup'ов. Опыт наших участников имеет ключевое значение для нас - от типов встреч, доступных для присоединения, до наблюдения за очевидными вещами, такими как безопасность каждого. Мы обычно утверждаем новые группы в течение 10 минут, после чего объявляем вашу группу всем местным членам с соответствующими интересами.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq6" class="collapsed">Как загрузить / распечатать список участников Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq6" class="collapse" data-parent="#faq-list">
                    <p>
                        После того, как вы запланировали встречу и люди получили приглашение, вы можете загрузить электронную таблицу своих участников.<br> чтобы загрузить список участников на рабочий стол и мобильный интернет:<br>
                            Перейдите на страницу события.<br>
                            Выберите инструменты организатора и выберите Управление RSVPs.<br>
                            Выберите сервис и выберите Загрузить участников.<br>
                            Это загрузит ваш список RSVP в документ электронной таблицы, где вы можете сортировать и печатать их имена.
                    </p>
                  </div>
                </li>
      
              </ul>
          </div>
        </div>

      </div>

    </section>
    <?php if(!$is_logged_in):?>
    <!--==========================
      Subscribe Section
    ============================-->
    <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Рассылка</h2>
          <p>Подпишитесь на нашу рассылку, которая отправит вам свежие новости о встречах.</p>
        </div>
        <form action="Server.php" method="post">
          <div class="form-row justify-content-center">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Введите свою почту" name = "newsletter">
              <input type="hidden" name = "header" value="location: index.php">
              <input type="hidden" name = "newsletter_sphere" value="nothing">
            </div>
            <div class="col-auto">
              <button type="submit" name="submit_newsletter">Подписаться</button>
            </div>
          </div>
        </form>

      </div>
    </section>
    <?php endif; ?>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Связаться с нами</h2>
          <p>Вы можете связаться с нами по любому вопросу</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Адресс</h3>
              <address>050040 Алматы, Ул. Манаса 34/1</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Номер телефона</h3>
              <p><a href="tel:+77087082628">+7 7087082628</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Эл. почта</h3>
              <p><a href="mailto:apushev.ye@gmail.com">apushev.ye@gmail.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Ваше сообщение отправлено. Спасибо!</div>
          <div id="errormessage"></div>
          <form action="Server.php" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Ваше имя" data-rule="minlen:4" data-msg="Пожалуйста, введите не менее 4 символов" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Ваша эл. почта" data-rule="email" data-msg="Пожалуйста, введите действительный адрес электронной почты" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Тема" data-rule="minlen:4" data-msg="Пожалуйста, введите не менее 8 символов" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Пожалуйста, напишите что-нибудь нам" placeholder="Письмо"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="send-email">Отправить письмо</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

<?php include ('footer.php'); ?>
</body>
</html>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>