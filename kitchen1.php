<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaishnavi's Khana Khazana</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <nav class="navbar">
        <h1>Vaishnavi's Khana Khazana</h1>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#menu">Menu</a>
            <?php if(isset($_SESSION['user'])): ?>
                <span style="font-weight:bold; color:#e23744;">Welcome, <?php echo $_SESSION['user']; ?>!</span>
                <a href="cart.php" style="background:#e23744; color:white; padding:8px 15px; border-radius:5px;">View Cart</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">LogIn</a>
                <a href="sign1.php">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <section class="hero" id="home">
        <h2>Experience Khana Khazana</h2>
        <p>The magic of home-cooked food, delivered with love.</p>
        <div class="search-box">
            <input type="text" id="menuSearch" placeholder="Search for Biryani, Pizza, Rolls..." onkeyup="filterMenu()">
            <button>Search</button>
        </div>
    </section>

    <main class="container" id="menu">
        <div class="section-header">
            <h2>Order Your Favorites</h2>
            <p>8 mouth-watering dishes curated just for you</p>
        </div>
        
        <div class="food-grid" id="foodGrid">
            <div class="food-card" data-name="Hyderabadi Biryani">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=500');"></div>
                <div class="food-info">
                    <h3>Hyderabadi Biryani</h3>
                    <p>Slow-cooked basmati rice & spices</p>
                    <div class="price-row">
                        <span class="price">₹320</span>
                        <button onclick="addToCart(1, 'Hyderabadi Biryani', 320)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Paneer Butter Masala">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=500');"></div>
                <div class="food-info">
                    <h3>Paneer Butter Masala</h3>
                    <p>Cottage cheese in tomato gravy</p>
                    <div class="price-row">
                        <span class="price">₹260</span>
                        <button onclick="addToCart(2, 'Paneer Butter Masala', 260)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Farmhouse Pizza">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500');"></div>
                <div class="food-info">
                    <h3>Farmhouse Pizza</h3>
                    <p>Fresh veggies & mozzarella</p>
                    <div class="price-row">
                        <span class="price">₹399</span>
                        <button onclick="addToCart(3, 'Farmhouse Pizza', 399)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Veg Spring Rolls">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?w=500');"></div>
                <div class="food-info">
                    <h3>Veg Spring Rolls</h3>
                    <p>Crispy rolls with spicy dip</p>
                    <div class="price-row">
                        <span class="price">₹150</span>
                        <button onclick="addToCart(4, 'Veg Spring Rolls', 150)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Creamy Pasta">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1645112411341-6c4fd023714a?w=500');"></div>
                <div class="food-info">
                    <h3>Creamy Pasta</h3>
                    <p>Penne in rich white sauce</p>
                    <div class="price-row">
                        <span class="price">₹280</span>
                        <button onclick="addToCart(5, 'Creamy Pasta', 280)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Double Patty Burger">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500');"></div>
                <div class="food-info">
                    <h3>Double Patty Burger</h3>
                    <p>Loaded with cheese & mayo</p>
                    <div class="price-row">
                        <span class="price">₹190</span>
                        <button onclick="addToCart(6, 'Double Patty Burger', 190)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Dal Tadka & Rice">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=500');"></div>
                <div class="food-info">
                    <h3>Dal Tadka & Rice</h3>
                    <p>Home-style comfort meal</p>
                    <div class="price-row">
                        <span class="price">₹180</span>
                        <button onclick="addToCart(7, 'Dal Tadka & Rice', 180)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-name="Choco Lava Cake">
                <div class="food-img" style="background-image: url('https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=500');"></div>
                <div class="food-info">
                    <h3>Choco Lava Cake</h3>
                    <p>Warm chocolate center</p>
                    <div class="price-row">
                        <span class="price">₹120</span>
                        <button onclick="addToCart(8, 'Choco Lava Cake', 120)" class="add-btn">Add +</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Send item information to backend PHP session using AJAX Fetch API
        function addToCart(id, name, price) {
            fetch('add_to_cart.php', {
                method: 'POST',
                //headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ item_id: id, item_name: name, item_price: price })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    alert(name + " added to your cart!");
                } else {
                    alert(data.message);
                    window.location.href = 'login.php';
                }
            });
        }

        // Live front-end search filter function
        function filterMenu() {
            let input = document.getElementById('menuSearch').value.toLowerCase();
            let cards = document.getElementsByClassName('food-card');
            for (let i = 0; i < cards.length; i++) {
                let name = cards[i].getAttribute('data-name').toLowerCase();
                if (name.includes(input)) {
                    cards[i].style.display = "";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>