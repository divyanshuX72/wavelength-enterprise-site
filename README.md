# Wavelength Enterprises — Premium Furniture & Interior Design Platform

## 📌 Project Overview
**Wavelength Enterprises** is a modern, dynamic web application designed for a premium custom furniture manufacturer. It bridges the gap between traditional craftsmanship and digital innovation by offering users an intuitive platform to browse catalogs, calculate EMI options, schedule consultations, and interact with an **AI-powered Interior Design Assistant**.

This project leverages a **Hybrid Architecture**:
- **Static Speed**: High-performance frontend for gallery and landing pages.
- **Dynamic Intelligence**: PHP backend for real-time AI interactions, form processing, and database management.

---

## 🛠️ Technology Stack

### **Frontend (Client-Side)**
- **Structure**: HTML5 (Semantic & SEO-optimized)
- **Styling**: **Tailwind CSS** (Utility-first framework for responsive, modern UI)
- **Interactivity**: **Vanilla JavaScript (ES6+)**
  - No heavy frameworks (React/Vue) used to ensure maximum performance and load speed.
  - Custom DOM manipulation for Modal Logic, Sliders, and Form Validation.

### **Backend (Server-Side)**
- **Language**: **PHP 8.x**
  - Chosen for its reliability, ease of deployment on XAMPP/Apache, and native MySQL support.
- **API Architecture**: RESTful endpoints (e.g., `backend/api/ai-chat.php`) handling JSON payloads.

### **Database**
- **System**: **MySQL (Relational Database)**
- **Key Tables**:
  - `products`: Stores furniture details, prices, and image paths.
  - `services`: Lists interior design services.
  - `form_submissions`: Captures user leads (Quotes, Visits).

### **Artificial Intelligence (The Brain)** 🧠
- **Core Model**: **Google Gemini 2.0 Flash** (via API).
- **Fallback Models**: Gemini 1.5 Flash, Gemini Pro (Automatic redundancy).
- **Integration**: Custom PHP Proxy (`ai-chat.php`) bridging the frontend and the LLM.

---

## 🚀 Key Features & Algorithms

### 1. **AI Interior Design Assistant (Advanced)**
The crown jewel of this project is the `ai-assistant.js` + `ai-chat.php` system.
- **Algorithm**: **RAG-Lite (Retrieval Augmented Generation)**
  1. **Data Injection**: On every request, the PHP script fetches the *live* product catalog (prices, stock, names) from MySQL.
  2. **System Prompting**: This data is injected into a strict system prompt that defines the AI's persona (Interior Designer) and rules (Format output as JSON).
  3. **Multi-Model Fallback Loop**:
     - *Try* Gemini 2.0 Flash (Fastest).
     - *If Quota Exceeded (429)* → *Try* Gemini 1.5 Flash.
     - *If API Error (500)* → *Try* Gemini Pro.
     - This ensures **99.9% availability** even on free tier keys.
  4. **Structured Output**: The AI returns JSON, allowing the frontend to render **Interactive Product Cards** (Images + Prices) instead of just plain text.
  5. **Context Memory**: Maintains a sliding window of the last 10 messages for conversational continuity.

### 2. **Dynamic Lead Generation**
- **Smart Forms**:
  - **EMI Calculator**: Real-time JS calculation for financial planning.
  - **Dynamic Dropdowns**: Furniture categories populate based on user selection.
  - **Validation**: Client-side (JS) + Server-side (PHP) validation to prevent spam.

### 3. **Gallery & Showcase**
- **Categorized Display**: Filterable gallery for Living Room, Bedroom, Office, etc.
- **Lazy Loading**: Images load only when needed to improve initial page speed.

---

## 🔄 System Flow Architecture

```mermaid
graph TD
    User[User / Customer] -->|Visits Website| Frontend[HTML/JS Frontend]
    
    subgraph "Client Side"
        Frontend -->|Browses| Gallery[Product Gallery]
        Frontend -->|Asks Question| AI_UI[AI Chat Widget]
        Frontend -->|Submits Lead| Forms[Contact/Quote Forms]
    end

    subgraph "Server Side (PHP)"
        AI_UI -->|POST Request (JSON)| AI_API[backend/api/ai-chat.php]
        Forms -->|POST Data| Form_Processor[process_contact.php]
    end

    subgraph "Database & External"
        AI_API -->|Fetch Products| DB[(MySQL Database)]
        AI_API -->|Send Prompt + Context| Gemini[Google Gemini API]
        Form_Processor -->|Store Lead| DB
    end

    Gemini -->|AI Response| AI_API
    AI_API -->|Structured JSON| AI_UI
```

---

## 🔮 Future Roadmap (Advanced Features)

To take Wavelength Enterprises to the next level, here are recommended upgrades:

### **1. Augmented Reality (AR) View** 🕶️
- **Feature**: Allow users to point their camera at their room and "place" a 3D model of a sofa or bed to see how it fits.
- **Tech**: `model-viewer` (Google) or `Three.js`.

### **2. Voice-Enabled AI** 🎙️
- **Feature**: Users can *talk* to the AI assistant in Hindi/English instead of typing.
- **Tech**: Web Speech API for Speech-to-Text (STT) and Text-to-Speech (TTS).

### **3. Admin Dashboard** 📊
- **Feature**: A secured panel for the business owner to:
  - Add/Update Products without coding.
  - View AI Chat logs to understand customer needs.
  - Manage Leads/Bookings.
- **Tech**: PHP Session Authentication + Chart.js for analytics.

### **4. User Accounts & Wishlist** ❤️
- **Feature**: Allow users to save their favorite designs and chat history.
- **Tech**: JWT Authentication + Expanded MySQL Schema.

### **5. Payment Gateway Integration** 💳
- **Feature**: Accept booking tokens or full payments online.
- **Tech**: Razorpay or Stripe API integration.

---

## 💾 Installation & Setup

1. **Environment**: Install XAMPP (Apache + MySQL).
2. **Database**: Import `backend/database.sql` into phpMyAdmin.
3. **Config**:
   - Updates DB credentials in `.env`.
   - Add **Gemini API Key** in `.env`.
4. **Run**: Start Apache/MySQL in XAMPP and visit `localhost/wavelength-enterprise-site`.

---
*Generated by AI Assistant for Wavelength Enterprises Analysis*
