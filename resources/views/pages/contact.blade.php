@extends('main')

@section('title','| Contact')

@section('content')
      <div class="row">
        <div class="col-md-12">

          <h1>Contact Me</h1>
          <hr>
          <form>
           
          
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
              <label for="subject">Subject</label>
              <input class="form-control" id="subject" name="subject">
            </div>

            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" name="message">Type your message here...</textarea>
            </div>
          
      
            
          
            <button type="submit" class="btn btn-success">Submit Message</button>
          </form>

        </div>
      </div>
@stop
   