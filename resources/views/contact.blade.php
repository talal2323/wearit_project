@extends('layouts.web')

@section('content')
    <!-- Contact Form Section -->
    <section class="container my-5"> <br>
        <h2>Contact Us</h2>
        <form id="contactForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="5" required></textarea>
            </div> <br>
            <button type="submit" class="btn btn-primary" onclick="initializeContactForm()">Submit</button>
        </form>
    </section>
@endsection

    