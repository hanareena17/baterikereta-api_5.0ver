import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonContent, IonHeader, IonTitle, IonToolbar, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonItem, IonLabel, IonButton, IonText } from '@ionic/angular/standalone';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
  standalone: true,
  imports: [IonContent, IonHeader, IonTitle, IonToolbar, CommonModule, FormsModule, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonItem, IonLabel, IonButton, IonText]
})
export class RegisterPage implements OnInit {
  name = '';
  email = '';
  password = '';
  password_confirmation = '';
  errorMessage = '';

  constructor(private http: HttpClient, private router: Router) { }

  ngOnInit(): void {
    // optional init logic here
  }
  

register() {
  const formData = {
    name: this.name,
    email: this.email,
    password: this.password,
    password_confirmation: this.password_confirmation
  };

  this.http.post<any>('http://127.0.0.1:8000/api/register', formData).subscribe({
    next: res => {
      localStorage.setItem('token', res.token);
      this.router.navigate(['/home']);
    },
    error: err => {
      this.errorMessage = err.error.message || 'Registration failed.';
    }
  });
}
}
