<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student - College Mess Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .meal-time {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Student Dashboard</a>
    </nav>
    <div class="container my-4">
        <h2>Weekly Mess Menu</h2>
        <div id="menuDisplay">
            <!-- Menu will be displayed here -->
        </div>
    </div>
    <script>
        // This script simulates fetching the menu from a server or local storage
        function getMenu() {
            return `
                <strong>Monday</strong><br>
                Morning: Pancakes<br>
                Afternoon: Chicken Salad<br>
                Snacks: Fruit<br>
                Dinner: Pasta<br><br>

                <strong>Tuesday</strong><br>
                Morning: Oatmeal<br>
                Afternoon: Beef Stir Fry<br>
                Snacks: Cookies<br>
                Dinner: Curry<br><br>

                <strong>Wednesday</strong><br>
                Morning: Smoothie<br>
                Afternoon: Sandwich<br>
                Snacks: Nuts<br>
                Dinner: Tacos<br><br>

                <strong>Thursday</strong><br>
                Morning: Bagels<br>
                Afternoon: Grilled Chicken<br>
                Snacks: Yogurt<br>
                Dinner: Stir Fry Vegetables<br><br>

                <strong>Friday</strong><br>
                Morning: French Toast<br>
                Afternoon: Salad Wraps<br>
                Snacks: Chips<br>
                Dinner: BBQ Ribs<br><br>

                <strong>Saturday</strong><br>
                Morning: Muffins<br>
                Afternoon: Quiche<br>
                Snacks: Popcorn<br>
                Dinner: Pizza<br><br>

                <strong>Sunday</strong><br>
                Morning: Eggs Benedict<br>
                Afternoon: Roast Beef<br>
                Snacks: Ice Cream<br>
                Dinner: Roast Chicken<br>
            `;
        }

        document.getElementById('menuDisplay').innerHTML = getMenu();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
