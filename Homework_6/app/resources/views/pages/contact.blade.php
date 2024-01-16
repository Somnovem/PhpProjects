@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Contact Ryan Gosling</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h3>Social Media</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="https://twitter.com/ryangosling" target="_blank">Twitter</a></li>
                    <li class="list-group-item"><a href="https://www.instagram.com/ryangosling/" target="_blank">Instagram</a></li>
                    <li class="list-group-item"><a href="https://www.facebook.com/ryangoslingofficial/" target="_blank">Facebook</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{$error}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h3>Email</h3>
                <p>You can also reach out to Ryan Gosling via email. Fill out the form below, and he will get back to you as soon as possible.</p>
                <form action="{{route('form.contact')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" style="margin-bottom: 5px;">Your Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" style="margin-bottom: 5px;">Your Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message" style="margin-bottom: 5px;">Your Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:10px;">Send Message</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <hr>
                <p class="lead">Connect with Ryan Gosling on social media or drop him a message. He values the support and feedback from his fans. Looking forward to hearing from you!</p>
            </div>
        </div>
    </div>
@endsection
