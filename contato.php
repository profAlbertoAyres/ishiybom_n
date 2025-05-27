<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/contato.css">
    <title>Localização | Agroindustrial</title>
    <style>
        /* header {
      background-color: #43a047;
      color: white;
      text-align: center;
      padding: 40px 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .container {
      max-width: 1000px;
      margin: auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      margin-top: -20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    } */
        .info p {
            margin: 10px 0;
            font-size: 1.1em;
        }

        .sec-branco a {
            color: #388e3c;
            text-decoration: none;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
        }

        h2 {
            border-bottom: 2px solid #a5d6a7;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <header>
        <?php include '_parts/_cabecalho_site.php' ?>
    </header>

    <main class="container">
        <section class="sec-branco">
            <h2>Nosso Endereço</h2>
            <p><strong>Local:</strong> Linha 128 ,km 04, lote 59 A, gleba 03 setor muqui Distrito - Estrela de Rondônia, Pres. Médici - RO</p>
            <div class="linha">
                <div class="item">
                    <p><strong>Telefones:</strong> (69)99909-5684 - (69)99991-5101</p>
                    <p><strong>E-mail:</strong> <a href="mailto:nogueira.jackson40@gmail.com">nogueira.jackson40@gmail.comr</a></p>
                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/5569999915101" target="_blank">(69)99991-5101</a></p>
                    <p><strong>Horário:</strong> Segunda a Sexta, das 7h às 18h</p>
                    <p>
                        <strong>Siga-nos:</strong>
                        <a href="https://www.facebook.com/Agroindústria-Ishiybom-100057126353801">Facebook</a> |
                        <a href="https://www.instagram.com/ishiybom">Instagram</a>
                    </p>
                </div>
                <div class="item">
                    <div class="img-centro">
                        <img src="images/ishiybom.png" alt="">
                    </div>
                </div>

            </div>
        </section>

        <section class="sec-branco">


            <h2>Como chegar</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3912.0397360134566!2d-61.82226802406258!3d-11.331806329003198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93c84dfcc72dd08f%3A0x1580b0c59141ef4f!2sAgroind%C3%BAstria%20Ishiybom%20agricultura%20Familiar!5e0!3m2!1spt-BR!2sbr!4v1748234054846!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </section>
    </main>
    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>