<? session_start(); // Запускаем сессию ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню</title>
    <link rel="stylesheet" href="https://happyhaha.github.io/css/dist/style.min.css">
    <!-- <link rel="stylesheet" href="./css/output.css"> -->
</head>
<body>
<h1 class="max-w-full mb-4 text-3xl font-extrabold tracking-tight leading-none md:text-5xl dark:text-white text-center">
    Калькулятор расходов</h1>
<?php if (isset($_SESSION['success'])): ?>
    <div class="w-[600px] mx-auto p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
         role="alert">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="w-[600px] mx-auto p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
         role="alert">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>


<?php
// Данные для подключения к базе данных
$host = "MySQL-8.0"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$database = "database_name"; // Имя базы данных
function dbConnect()
{
    global $host, $username, $password, $database; // Получаем доступ к глобальным переменным
    $conn = mysqli_connect($host, $username, $password, $database); // Подключаемся к базе данных
    if (!$conn) { // Если подключение не удалось...
        die("Connection failed: " . mysqli_connect_error()); // ...выводим сообщение об ошибке и завершаем скрипт
    }
    return $conn; // Возвращаем объект соединения
}

// Функция для получения всех расходов из базы данных
function getExpenses()
{
    $conn = dbConnect(); // Подключаемся к базе данных
    $sql = "SELECT * FROM expenses"; // Формируем SQL-запрос для выборки всех расходов
    $result = mysqli_query($conn, $sql); // Выполняем запрос
    return mysqli_fetch_all($result, MYSQLI_ASSOC); // Возвращаем массив с расходами
}

// Функция для подсчета общей суммы расходов
function calculateTotalExpenses($expenses)
{
    $total = 0; // Инициализируем переменную для хранения суммы
    foreach ($expenses as $expense) { // Перебираем массив с расходами
        $total += $expense['amount']; // Суммируем значения расходов
    }
    return $total; // Возвращаем общую сумму
}

?>


<div class="w-[1200px] mt-6 mx-auto flex justify-around">
    <div class="mb-5 w-[300px]">

        <form class="" method="post" action="task9_process.php">
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название
                    расхода</label>
                <input type="text" id="text"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       name="expense_name" required/>
            </div>
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Сумма</label>
                <input type="number" id="number"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       name="expense_amount" required/>
            </div>
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Добавить расход
            </button>
        </form>
    </div>
    <div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Название расхода
                </th>
                <th scope="col" class="px-6 py-3">
                    Сумма
                </th>
                <th scope="col" class="px-6 py-3">
                    Действия
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Получаем все расходы из базы данных
            $expenses = getExpenses(); // Вызываем функцию для получения расходов

            // Вывод расходов
            if (count($expenses) > 0) { // Если расходы есть...
                foreach ($expenses as $expense) { // ...перебираем массив с расходами
                    ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo $expense['name']; ?> <!-- Выводим название расхода -->
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $expense['amount']; ?> <!-- Выводим сумму расхода -->
                        </td>
                        <td class="px-6 py-4">
                            <a href="task9_delete.php?id=<?php echo $expense['id']; ?>"
                               class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Удалить</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" class="text-center">Расходов пока нет.</td>
                </tr>
                <?php
            }

            // Вывод итоговой суммы
            $total = calculateTotalExpenses($expenses); // Вызываем функцию для подсчета суммы
            ?>
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-black text-gray-900 whitespace-nowrap dark:text-white">
                    Итого
                </th>
                <td class="px-6 py-4 font-black text-black">
                    <?php echo $total; ?> <!-- Выводим итоговую сумму -->
                </td>
            </tr>


            </tbody>
        </table>
    </div>
    </form>


    <script src="https://happyhaha.github.io/css/dist/flowbite.min.js"></script>
</body>
</html>