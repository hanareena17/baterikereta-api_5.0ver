// import { Component, OnInit } from '@angular/core';
// import { CommonModule } from '@angular/common';
// import { FormsModule } from '@angular/forms';
// import { HttpClient, HttpHeaders } from '@angular/common/http';
// import { IonContent, IonHeader, IonTitle, IonToolbar, NavController, IonCardContent, IonButton, IonInput, IonItem, IonLabel, ToastController } from '@ionic/angular/standalone';

// @Component({
//   selector: 'app-verify-otp',
//   templateUrl: './verify-otp.page.html',
//   styleUrls: ['./verify-otp.page.scss'],
//   standalone: true,
//   imports: [IonContent, IonHeader, IonTitle, IonToolbar, CommonModule, FormsModule, NavController, IonCardContent, IonButton, IonInput, IonItem, IonLabel, ToastController]
// })
// export class VerifyOtpPage implements OnInit {

//   constructor(private http: HttpClient, private navCtrl: NavController) { }

//   ngOnInit() {
//     const storedId = localStorage.getItem('user_id');
//     if (storedId) this.userId = storedId;
//   }

//   verifyOtp() {
//     const url = 'http://127.0.0.1:8000/api/verify-otp';

//     const payload = {
//       otp: this.otp,
//       user_id: this.userId
//     };
//     this.http.post<any>(url, payload).subscribe({
//       next: res => {
//         localStorage.setItem('token', res.token);
//         alert('OTP Verified!');
//         this.navCtrl.navigateRoot('/home');
//       },
//       error: err => {
//         console.error(err);
//         alert('Invalid or expired OTP.');
//       }
//     });
//   }
  
//   }


