<style>
    body {
        background-color: #f8f9fa;
    }

    .access-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .access-box {
        max-width: 420px;
        padding: 20px;
    }

    .access-box img {
        max-width: 260px;
        margin-bottom: 25px;
    }

    .access-box h2 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .access-box p {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }

    .btn-home {
        padding: 8px 26px;
        border-radius: 6px;
        font-weight: 500;
    }

      .btn-home {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        background: #4f46e5;
        border: none;
        color: #fff;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 6px 18px rgba(79, 70, 229, 0.25);
    }

    .btn-home:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(79, 70, 229, 0.35);
        color: #fff;
        text-decoration: none;
    }
</style>

<div class="access-wrapper">
    <div class="access-box">
        <img src="https://cdn-icons-png.flaticon.com/512/9954/9954450.png"
     alt="Access Denied"
     class="img-fluid mx-auto d-block mb-3"
     style="max-width:240px;">




        <h2>Access denied!</h2>
        <p>
            YOU ARE NOT AN ADMIN!
            <br>
            You do not have permission to access this area of the application.
        </p>

       <a href="{{ route('dashboard') }}" class="btn-home">
    Go back Home
</a>
    </div>
</div>
