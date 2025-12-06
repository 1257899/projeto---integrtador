<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/9c2860eb6a.js" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<?php
// Faz o include dos arquivos js referentes aos aos módulos pegando o valor de 'p' passado como parâmetro na url
if ($valor == '') {
} else if ($valor == 'edicoes') {
    echo '<script src="js/edicoes.js"></script>';
} else if ($valor == 'participantes') {
    echo '<script src="js/participantes.js"></script>';
} else if ($valor == 'projetos') {
    echo '<script src="js/projetos.js"></script>';
} else if ($valor == 'temas') {
    echo '<script src="js/temas.js"></script>';
}
?>
</body>

</html>