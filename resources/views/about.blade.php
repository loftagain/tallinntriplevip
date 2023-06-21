@extends('layouts.app')

@section('content')
<style>
        body {
            background-image: url('{{ asset('images/background70.jpg') }}');
            background-size: cover;
            background-position: center;
            
        }
        .card {
            margin: 0 auto; //golden
            margin-bottom:20px;
    align-content: center;
    width:50%;
     justify-content: center;
     align-content: center;
     text-align: center;
     padding:5px 5px 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
        border-radius: 6px;
        overflow: hidden;
        background-color: rgba(255, 214, 51);

    }
    .card + .card {
  margin-top: 20px;
}   
    p {
        line-height: 1.5em;
    }

    .card-body {
        padding: 15px 15px 15px;
    }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <p>Tallinn Triple VIP is a fine-dining pancake experience in Tallinn Old Town. Now we are welcoming you
                to add to this experience by submitting your idea for our monthly special pancake dish! Since we love to know more about 
                our visitors, leave a message about your visit here, what brought you here, what meal you already had and 
                leave an insight into a recipe you would love to have named after you. Each month 3 posts with the most votes are 
                discussed by our chefs and the most suitable we award as the winner! The winner gets a chance to book the premium table and
                enjoy their dish with appetizers and a drink free or charge as well as they earn the lucky spot on our winners' wall!
                Happy voting, we can't wait to hear from you soon and may the odds be eva in yo feiva.</p></div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                  
                    <p>Opening hours:  Everyday 11:00 a.m to 23:00 p.m (Take note that kitchen closes at 21:45p.m.)</>
                    
                    <p>Telephone: +372 646 4210</p>
                    
                    <p>Address: Rataskaevu 3, 10123, Tallinn</p>
                    <p>Questions: admin@tallinntriplevip.ee</p>
                    <div class="googlemaps">
                        <iframe width="400" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4500164.92118507!2d21.681885243111626!3d56.58231503539089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4692936265952647:0xee3a2b98c6c326ba!2sKompressor!5e0!3m2!1sen!2sau!4v1567854989384!5m2!1sen!2sau"></iframe>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection
