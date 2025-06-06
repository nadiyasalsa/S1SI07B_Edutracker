<head>
  <title>EDUTRACKER</title>
  <link rel="stylesheet" href="style.css">
</head>
/* Reset dasar */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background: #f8f5fc;
  color: #333;
  line-height: 1.6;
  padding: 20px;
}

/* Container utama */
form, .content, nav {
  background-color: #ffffff;
  padding: 20px;
  margin: 10px auto;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(128, 0, 128, 0.1);
  max-width: 600px;
}

/* Judul halaman */
h1 {
  text-align: center;
  color: #5e2c82;
  margin-bottom: 20px;
}

/* Navigasi */
nav {
  display: flex;
  justify-content: space-around;
  background-color: #7e57c2;
  border-radius: 10px;
  padding: 15px;
}

nav a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

nav a:hover {
  text-decoration: underline;
}

/* Form */
form input, form select, form textarea, form button {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #c8a2c8;
  border-radius: 8px;
  font-size: 16px;
}

form button {
  background-color: #7e57c2;
  color: white;
  border: none;
  cursor: pointer;
  font-weight: bold;
}

form button:hover {
  background-color: #6a3fa0;
}

/* Tugas dan notifikasi */
div {
  background: #f4ecfb;
  border-left: 5px solid #9b59b6;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 15px;
}

hr {
  border: none;
  border-top: 1px solid #d1c4e9;
  margin: 20px 0;
}

/* Link edit dan hapus */
a {
  color: #7e57c2;
  text-decoration: none;
  font-weight: bold;
}

a:hover {
  text-decoration: underline;
}