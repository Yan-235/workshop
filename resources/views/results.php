<?php
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

// подключение к бд
try {
  $dbh = new PDO('mysql:dbname=workshop;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  echo "Error: Could not connect. " . $e->getMessage();
}

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// выполняем запрос
try {
  // формируем SELECT запрос
  // в результате каждая строка таблицы будет объектом
  $sql = "SELECT users.id AS id, users.name AS name, users.email AS email, users.created_at AS created_at FROM users";
  $sth = $dbh->query($sql);
  while ($row = $sth->fetchObject()) {
    $results[] = $row;
  }

  // закрываем соединение
  unset($dbh);

  $loader = new Twig_Loader_Filesystem('templates');

  $twig = new Twig_Environment($loader);

  $template = $twig->loadTemplate('countries2.tmpl');

  echo $template->render(array (
    'results' => $results
  ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>