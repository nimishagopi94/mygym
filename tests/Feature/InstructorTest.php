<?php
use App\Models\User;
use App\Models\ClassType;

test('instructor_is_redirected_to_instructor_dashboard', function () {

    $user = User::factory()->create([
        'role'=>'instructor'
    ]);
    $response = $this->ActingAs($user)
    ->get('/dashboard');

    $response->assertRedirectToRoute('instructor.dashboard');
    $this->followRedirects($response)->assertSeeText("hey Instructor");
});
test('instructor_can_schedule_a_class',function(){
    $user = User::factory()->create([
        'role'=>'instructor'
    ]);

   $this->seed(ClassTypeSeeder::class);
   $response = $this->actingAs($user)
   ->post('instructor/schedule',[
    'class_type_id' => ClassType::first()->id,
    'date' => '2025-03-25',
    'time'=>'16:00:00'
   ]);
   $response->assertRedirectToRoute('schedule.index');
});
