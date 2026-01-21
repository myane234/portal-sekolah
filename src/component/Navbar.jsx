import React from 'react';

const Navbar = () => {
    return (
        <nav style={styles.nav}>
      <h2 style={styles.logo}>MyApp</h2>

      <ul style={styles.menu}>
        <a href="#home"><li>Home</li></a>
        <a href="#about"><li>About</li></a>
        <a href="#contact"><li>Contact</li></a>
      </ul>
    </nav>
    )
}

const styles = {
  nav: {
    display: "flex",
    justifyContent: "space-between",
    alignItems: "center",
    padding: "16px 32px",
    background: "#111",
    color: "#fff",
  },
  logo: {
    margin: 0,
  },
  menu: {
    display: "flex",
    gap: "24px",
    listStyle: "none",
    margin: 0,
  },
};

export default Navbar;