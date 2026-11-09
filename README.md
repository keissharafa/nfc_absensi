# 🪪 NFC-Based Real-Time Attendance System

> An enterprise-grade attendance backend designed for seamless physical-to-digital operational tracking using NFC technology.

## 🚀 Overview
This system modernizes attendance and operational tracking by leveraging NFC (Near Field Communication) cards. Designed with factory or enterprise environments in mind, it handles card registration, serial-number validation, and real-time data broadcasting to a web interface.

## ✨ Key Features
* **Card Registration & Validation:** Secure mapping of physical NFC serial numbers to database records.
* **Real-Time Display:** Instantaneous visual feedback on the web interface upon successful card scans.
* **Hardware Mocking (Simulated Endpoint):** Includes a fully functional simulated scan endpoint to validate backend logic and bypass cross-platform hardware limitations (e.g., iOS to Windows NFC bridging) during development.

## 🛠️ Tech Stack
* **Backend:** Laravel, PHP
* **Frontend UI:** Vanilla JavaScript, Blade
* **Database:** MySQL

## 💡 Engineering Highlight
**Resilient Hardware Integration:** Encountered hardware restrictions during physical NFC reader integration. Solved this by engineering a *simulated scan endpoint* (hardware mocking), allowing continuous backend logic validation, testing, and CI/CD without being bottlenecked by hardware dependencies.
