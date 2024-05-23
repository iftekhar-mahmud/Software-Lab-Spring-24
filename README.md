# Project Documentation: Clinic Management System

## Course Information

```
Course Title : Software Engineering Laboratory

Course Code : CSE 3422/CSI 322 (C)
```

## Group Information

```
Group 6 : Team BlueBird

Iftekhar Mahmud, Student ID: 011182073

MD Abdul Haque Rahid, Student ID: 011181142

Fatema, Student ID : 011193055

Rifah Khan, Student ID: 011163015

Moriomer Nesa Dolon, Student ID: 011191013
```



## Introduction

The Clinic Management System is a transformative web-based application designed to address the challenges faced by healthcare facilities and small practices in underdeveloped areas. In many regions, traditional paper-based methods persist, leading to inefficiencies, security risks, and limited access to vital patient information. The motivation behind developing this system stems from the urgent need to revolutionize healthcare management by providing a tailored digital solution that enhances efficiency, improves patient care, and fosters a digital transformation in healthcare delivery.

Healthcare facilities in underdeveloped areas often grapple with the daunting task of managing patient records, scheduling appointments, and coordinating care with limited resources and outdated methods. This System represents a significant step towards bridging the technological gap in healthcare and ensuring that even resource-challenged facilities have access to modern tools for effective patient care.


### Objectives:

The primary objective of the This System project is to replace traditional paper-based methods with a comprehensive digital solution that revolutionizes healthcare management. By digitizing patient records, automating administrative tasks, and enhancing data security measures, This System aims to improve operational efficiency, reduce errors, and ultimately enhance patient outcomes. Additionally, the project seeks to empower healthcare providers with user-friendly tools that simplify workflows and enable them to focus more on delivering compassionate care to their patients.


### Target Audience:


This system is designed to cater to a diverse range of stakeholders within the healthcare ecosystem. This includes healthcare professionals such as doctors, nurses, and administrative staff who rely on efficient patient record management systems to perform their duties effectively. Furthermore, healthcare administrators and policymakers may also find value in the system's ability to generate insights and optimize resource allocation for improved healthcare delivery.


### Key Features:

This system boasts a comprehensive suite of features designed to streamline healthcare management processes and enhance patient care. From patient information management to appointment scheduling and beyond, the system offers a range of functionalities that set it apart from traditional paper-based methods and other existing solutions. Key features include:

- Department Table
- Services
- Package Management
- Employee Management
- Doctor Management
- Patient Management
- Appointment Management
- Haematology Test
- Biochemistry Test
- Immunology Test
- Microbiology Test
- Examination Test
- Stain Test
- User Management
- Role Management


### Benefits:

By implementing this system, healthcare facilities and small practices can expect to realize a multitude of benefits. These include

- Improved operational efficiency through streamlined workflows and automation of repetitive tasks.
- Enhanced data security measures to safeguard sensitive patient information and comply with regulatory requirements.
- Better patient outcomes through more accurate diagnosis, personalized treatment plans, and improved care coordination.
- Overall optimization of the healthcare ecosystem, with potential cost savings, reduced administrative burdens, and improved resource allocation.

### Scope:


The scope of this system project encompasses the development and implementation of a web-based application tailored to the needs of healthcare facilities and small practices in underdeveloped areas. The system will primarily focus on key functionalities related to patient information management, appointment scheduling, and administrative tasks. While the initial version of the system may have certain limitations or constraints, future iterations will aim to expand its scope and capabilities to meet evolving healthcare needs.



## Tools and Technology

Our Software is developed with: 

- PHP with Laravel Web Framework
- MySQL  
- HTML and CSS
- JavaScript and BootStrap

And for version control, we have used:

- Git and Github

Link to our project : [GitHub](https://github.com/iftekhar-mahmud/softlab) `https://github.com/iftekhar-mahmud/softlab`

## Installation Guide:

To install and run this System project from GitHub, follow these steps:

1. **Clone the Repository:**
   `
  git clone https://github.com/iftekhar-mahmud/softlab.git
   `
   

2. **Navigate to the Project Directory:**
  `
  cd ClinicManagement
  `

3. **Install Dependencies:**
  `
  composer install
  `

4. **Set Up Environment Variables:**
  Copy the `.env.example` file and rename it to `.env`. Update the necessary environment variables such as database connection details, application key, etc.

5. **Generate Application Key:**
  `
  php artisan key:generate
  `

6. **Run Migrations:**
  `
  php artisan migrate
  `

7. **Start the Development Server:**
  `
  php artisan serve
  `

8. **Access the Application:**
  Open your web browser and navigate to `http://localhost:8000` to access the EHR System.


## Preview of the Software

![Preview of Software](<<a href="https://ibb.co/8KqDTRj"><img src="https://i.ibb.co/ng9sZVD/collage.jpg" alt="collage" border="0" /></a>>)


## Technical Documentation

### Database

We used the migration system of Laravel to create our database and used the index key to connect one table with another. For example, given below is the create_appointments_table.php file from database > migration directory. 

`
public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('description')->nullable();
        $table->string('time')->nullable();
        $table->timestamp('appointment_date')->nullable();
        $table->boolean('status')->default(0);
        $table->unsignedInteger('patient_id');
        $table->unsignedInteger('doctor_id');
        $table->timestamps();


        // Defining foreign keys
        $table->foreign('patient_id')->references('id')->on('patients');
        $table->foreign('doctor_id')->references('id')->on('doctors');
    });
}


public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        // Dropping foreign keys
        $table->dropForeign(['patient_id']);
        $table->dropForeign(['doctor_id']);
    });


    Schema::dropIfExists('appointments');
}

`

And this is how it looks on xaamp 

![Appointment Table shown in xaamp phpmyadmin](<<a href="https://ibb.co/n808qWL"><img src="https://i.ibb.co/VpNp0Kq/appointment-table.png" alt="appointment-table" border="0" /></a>>)


### Databse Migration Code Explanation 

**1. Class Definition and Use Statements**

`
  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;
  class CreateAppointmentsTable extends Migration
`

  This section defines the migration class CreateAppointmentsTable and includes the necessary namespaces for Schema, Blueprint, and Migration.


**2. Running the Migration (up Method)**

`
  public function up()
  {
    Schema::create('appointments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('description')->nullable();
        $table->string('time')->nullable();
        $table->timestamp('appointment_date')->nullable();
        $table->boolean('status')->default(0);
        $table->unsignedInteger('patient_id');
        $table->unsignedInteger('doctor_id');
        $table->timestamps();
        $table->foreign('patient_id')->references('id')->on('patients');
        $table->foreign('doctor_id')->references('id')->on('doctors');
    });
  }
`

  ***Explanation***

   `Schema::create('appointments', function (Blueprint $table) {...});`: This line creates a new table named appointments using the schema builder.

   `$table->increments('id');`: This creates an auto-incrementing integer column named id which serves as the primary key for the table.

   `$table->string('name');`: This creates a string column named name to store the name of the appointment.

   `$table->string('description')->nullable();`: This creates a string column named description which is nullable, meaning it can store NULL values.

   `$table->string('time')->nullable();`: This creates a string column named time which is also nullable.

   `$table->timestamp('appointment_date')->nullable();`: This creates a timestamp column named appointment_date which is nullable.

   `$table->boolean('status')->default(0);`: This creates a boolean column named status with a default value of 0.

   `$table->unsignedInteger('patient_id');`: This creates an unsigned integer column named patient_id to store the ID of the associated patient.

   `$table->unsignedInteger('doctor_id');`: This creates an unsigned integer column named doctor_id to store the ID of the associated doctor.

   `$table->timestamps();`: This creates two timestamp columns named created_at and updated_at which Laravel will manage automatically.


  ***Foreign Keys:***

   `$table->foreign('patient_id')->references('id')->on('patients');`: This defines a foreign key constraint for the patient_id column, linking it to the id column on the patients table.

   `$table->foreign('doctor_id')->references('id')->on('doctors');`: This defines a foreign key constraint for the doctor_id column, linking it to the id column on the doctors table.


**3. Reversing the Migration (down Method)**

`
  public function down()
  {
     Schema::table('appointments', function (Blueprint $table) {
        $table->dropForeign(['patient_id']);
        $table->dropForeign(['doctor_id']);
     });
     Schema::dropIfExists('appointments');
  }
`
  

  ***Explanation:***

   `Schema::table('appointments', function (Blueprint $table) {...});`: This section modifies the existing appointments table.

  ***Dropping Foreign Keys:***

   `$table->dropForeign(['patient_id']);`: This drops the foreign key constraint on the patient_id column.

   `$table->dropForeign(['doctor_id']);`: This drops the foreign key constraint on the doctor_id column.
   
   `Schema::dropIfExists('appointments');`: This drops the appointments table if it exists.


## Application Code Explanation

For each feature, we used resources > views for frontend and app > Http > Controllers for backend. For example in the Appointment feature, This is the part from resources > views > appointments > index.blade.php. This works as a frontend.

### resources > views > appointments > index.blade.php.

It extends a layout template and includes partial views for adding and editing appointments and JavaScript functionalities. Here's a detailed explanation of each part.

**1. Extending the Layout and Including Partials**

`
@extends('layouts.app')
@section('content')
@include('appointments.partials.add')
@include('appointments.partials.edit')
@include('appointments.partials.js')
`

`@extends('layouts.app')`: This line indicates that the view extends the app layout. This layout likely includes the basic HTML structure and common elements like the header and footer.

`@section('content')`: This defines the start of the content section that will be injected into the layout.

`@include('appointments.partials.add')`: Includes a partial view for adding an appointment.

`@include('appointments.partials.edit')`: Includes a partial view for editing an appointment.

`@include('appointments.partials.js')`: Includes a partial view for JavaScript related to appointments.

**2. Breadcrumb Navigation**

`
<div class="col-lg-12 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Icons</li>
            <li>Appointment</li>
        </ol>
    </div><br><!--/.row-->
`

This section displays a breadcrumb navigation trail, helping users understand their current location within the web application.

**3. Displaying Success and Error Messages**

`
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
</div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
`

Success Message: Displays a success message if one exists in the session.

Error Messages: Displays validation error messages if any exist.

**4. Main Content Area**

***Panel Header***

`
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Appointment Table
                <a class="btn btn-success pull-right" data-toggle="modal" href="#addAppointment">
                    <span class="glyphicon glyphicon-plus"></span>Add Appointment
                </a>
            </div>
            <div class="panel-body">


`
`<div class="panel panel-default"> ` This creates a Bootstrap panel and contains the title "Appointment Table" and a button to add a new appointment.

***Appointment Table***

`
@if($appointments->count())
    <table id="example" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th data-sortable="true">ID</th>
                <th data-sortable="true">Name</th>
                <th data-sortable="true">Patient Name</th>
                <th data-sortable="true">Doctor</th>
                <th data-sortable="true">Description</th>
                <th data-sortable="true">Time</th>
                <th>Date</th>
                <th data-sortable="true">Status</th>
                <th data-sortable="true">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $key => $appointment)
                <tr>
                    <td>{{$appointment->id}}</td>
                    <td>{{$appointment->name}}</td>
                    <td>{{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</td>
                    <td>{{$appointment->doctor->employee->first_name}} {{$appointment->doctor->employee->middle_name}} {{$appointment->doctor->employee->last_name}}</td>
                    <td>{{$appointment->description}}</td>
                    <td>{{$appointment->time}}</td>
                    <td>{{$appointment->appointment_date}}</td>
                    <td> 
                        @if($appointment->status)
                            <a class="btn btn-sm btn-success" href="{{ route('appointment.edit',$appointment->id) }}">
                                <span class=" glyphicon glyphicon-ok"></span> Completed
                            </a>	
                        @else
                            <a class="btn btn-sm btn-warning" href="{{ route('appointment.edit',$appointment->id) }}">
                                <span class=" glyphicon glyphicon glyphicon-refresh"> </span> Pending
                            </a>
                        @endif
                    </td>
                    <td>
                        <button class="edit-appointment btn btn-primary" data-info="{{$appointment->id}},{{$appointment->name}},{{$appointment->description}},{{$appointment->time}},{{$appointment->doctor_id}},{{$appointment->patient_id}} {{$appointment->working_date}}">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        @permission('appointment.delete')
                        <button class="delete-modal btn btn-danger" data-info="{{$appointment->id}}" id="deleteConfirm">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                        @endpermission
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h3 align="center">Sorry No appointment Found</h3>
@endif
`
***Table Structure:*** Displays appointments in a table format with columns for ID, Name, Patient Name, Doctor, Description, Time, Date, Status, and Action.

***Loop through Appointments:*** Uses a `foreach` loop to display each appointment's details.

***Status Buttons:*** Displays different buttons based on the appointment's status (Completed or Pending).

***Action Buttons:*** Includes buttons for editing and deleting appointments. The edit button uses a `data-info` attribute to store appointment information for use in JavaScript.

**5. Closing Tags**

`
           </div>
        </div>
    </div>
</div><!--/.row-->	
</div><!--/.main-->
@endsection
`
These lines close the remaining HTML tags and end the Blade `@section` directive.

### app > Http > AppointmentController.php.

Now this is the part from app > Http > AppointmentController.php. This works as a backend. This `AppointmentController` class in Laravel handles CRUD operations for Appointment records. Here's an explanation of each method and its purpose:

**1. Index Method**
`
public function index()
{
    $appointments = Appointment::get();
    $patients = Patient::get();
    $doctors = Doctor::get();
    return view('appointments.index', compact('appointments', 'patients', 'doctors'));
}
`
***Purpose:*** Displays a listing of all appointments.

***Logic:*** Fetches all appointments, patients, and doctors from the database and returns a view named appointments.index, passing the fetched data to the view.

**2. Create Method**
`
public function create()
{
    //
}
`
***Purpose:*** Show the form for creating a new appointment.

***Logic:*** Currently empty, as the form might be handled in a different way or view.

**3. Store Method**
`
public function store(Request $request)
{
    $request['appointment_date'] = date('Y-m-d', strtotime($request->appointment_date));
    $data = $request->all();
    $this->validate($request, ['doctor_id' => 'required|numeric', 'patient_id' => 'required']);
    Appointment::create($data);
    return back()->with('success', 'Appointment saved Successfully.');
}
`
***Purpose:*** Store a newly created appointment in the database.

***Logic:*** 

- Converts appointment_date to the Y-m-d format.

- Validates that doctor_id is numeric and patient_id is required.

- Stores the validated data in the appointments table.

- Redirects back with a success message.

**4. Show Method**
`
public function show($id)
{
    //
}
`
***Purpose:*** Display the specified appointment.

***Logic:*** Currently empty, as this function might be handled elsewhere.

**5. Edit Method**
`
public function edit($id)
{
    $appointment = Appointment::find($id);

    if ($appointment->status) {
        $appointment->status = 0;
    } else {
        $appointment->status = 1;
    }
    $appointment->save();
    return back()->with('success', 'Status changed successfully.');
}
`
***Purpose:*** Show the form for editing the specified appointment.

***Logic:***

- Find the appointment by its ID.

- Toggles the status between 0 and 1.

- Saves the updated status.

- Redirects back with a success message.

**6. Update Method**
`
public function update(Request $request)
{
    // Currently empty, as the actual update logic is handled in `updated` method.
}
`
***Purpose:*** Update the specified appointment in the database.

***Logic:*** Empty because the update logic is in the updated method.

**7. Updated Method**
`
public function updated(Request $request)
{
    $this->validate($request, ['doctor_id' => 'required']);
    if ($request->appointment_date) {
        $request['appointment_date'] = date('Y-m-d', strtotime($request->appointment_date));
    }
    $appointment = Appointment::find($request->id);
    $appointment->update($request->all());
    return back()->with('success', 'Appointment updated successfully');
}
`
***Purpose:*** Update the specified appointment in the database.

***Logic:***

- Validates that doctor_id is required.

- Converts appointment_date to the Y-m-d format if provided.

- Finds the appointment by its ID and updates it with the requested data.

- Redirects back with a success message.

**8. Destroy Method**
`
public function destroy($id)
{
    return back()->with('success', 'Appointment cannot be deleted.');
}
`

***Purpose:*** Remove the specified appointment from storage.

***Logic:*** Returns back with a message saying the appointment cannot be deleted.

**9. Toggle Status Method**
`
public function toggleStatus($id)
{
    $appointment = Appointment::find($id);
    if ($appointment->status) {
        $appointment->status = 0;
    } else {
        $appointment->status = 1;
    }
    $appointment->save();
    return back();
}
`
***Purpose:*** Toggle the status of the specified appointment.

**Logic:**

- Find the appointment by its ID.
- Toggles the status between 0 and 1.
- Saves the updated status.
- Redirects back.




## Version Control

We have used GitHub to use version control. Link to all the commits : [GitHub Commits](https://github.com/iftekhar-mahmud/softlab/commits/main/) `https://github.com/iftekhar-mahmud/softlab/commits/main/`


## Diagrams

### Use Case Diagram 


![Use Case Diagram](<a href="https://ibb.co/31j8hGJ"><img src="https://i.ibb.co/F6yf7NP/use-case-diagram.png" alt="use-case-diagram" border="0" /></a>)

### Class Diagram 


![Class Diagram](<a href="https://ibb.co/N2szWp3"><img src="https://i.ibb.co/gZ3Ctw7/class-diagam.png" alt="class-diagam" border="0" /></a>)


### Activity Diagram

![Activity Diagram](<a href="https://ibb.co/QFt69Wt"><img src="https://i.ibb.co/XZMzXnM/activity.png" alt="activity" border="0" /></a>)




