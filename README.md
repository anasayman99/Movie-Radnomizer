# 🎬 MovieRandomizer – Dynamic Movie Recommendation Web App

MovieRandomizer is a **PHP–MySQL full-stack web app** where users register, log in, set movie preferences, spin a wheel for random suggestions, and manage a personal movie collection.  
Built for **CST8285 – Web Programming**, it demonstrates **frontend, backend, and database integration**.

---

## 🚀 Key Features
- **User Auth** – Registration/login with hashed passwords & session control.
- **Random Movie Spinner** – Visual wheel with AJAX-based results.
- **Collection Management** – Add/remove/view movies instantly via fetch().
- **Search & Filter** – Live search by genre, mood, runtime.
- **Client-Side Validation** – Inline JS validation, no HTML5 defaults.
- **Responsive UI** – Mobile-first dark theme.

---

## 🛠 Tech Stack
**Frontend:** HTML5, CSS3, JavaScript (ES6)  
**Backend:** PHP 8 (Procedural)  
**Database:** MySQL (XAMPP, phpMyAdmin)  
**Server:** Apache  
**Version Control:** Git & GitHub  

---

## 🗄 Database
**users** – Stores account info & preferences  
**movies** – Stores all movie records  
**collections** – Many-to-many link between users & movies (`ON DELETE CASCADE`)  

---

## 📂 Structure

Database/ # SQL scripts
Html/ # Pages
Js/ # JavaScript
Server/ # PHP scripts
Styles/ # CSS
Images/ # Posters/UI
Documentations/ # Guides & diagrams


---

## ⚙️ Setup
1. Clone repo → move to `C:\xampp\htdocs\MovieRandomizer`
2. Import `Database/movie_app.sql` into MySQL
3. Update `Server/db_connect.php` with your DB credentials
4. Run `http://localhost/MovieRandomizer/Html/index.html`

---

## 🔄 Flow
Browser (HTML+JS) → fetch() → PHP backend → MySQL → PHP JSON → JS DOM update.

---

**Author:** Anas Sadek – Algonquin College  



