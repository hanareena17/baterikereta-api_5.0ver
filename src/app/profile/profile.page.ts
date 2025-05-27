import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonContent, IonHeader, IonTitle, IonToolbar, IonButton, IonCardContent, IonAvatar, IonItem, IonIcon,  IonLabel,  IonList, IonListHeader, IonFab, IonFabButton, IonBackButton, IonButtons} from '@ionic/angular/standalone';
import { HttpClient, HttpHeaders } from '@angular/common/http';



@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
  standalone: true,
  imports: [IonContent, IonHeader, IonTitle, IonToolbar, CommonModule, FormsModule, IonButton, IonCardContent, IonAvatar, IonItem, IonIcon,  IonLabel,  IonList, IonListHeader, IonFab, IonFabButton, IonBackButton, IonButtons ]
})
export class ProfilePage implements OnInit {
  user: any;

  constructor(private http: HttpClient) { }

  ngOnInit() {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders({ 'Authorization': `Bearer ${token}` });

    this.http.get<any>('http://127.0.0.1:8000/api/user', { headers }).subscribe({
      next: res => {
        this.user = res.data ?? res;
        console.log('User Info:', this.user);
      },
      error: err => {
        console.error('Failed to fetch user info:', err);
      }
    });
  }

  logout(): void {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders({ 'Authorization': `Bearer ${token}` });
  
    this.http.post('http://127.0.0.1:8000/api/logout', {}, { headers }).subscribe(() => {
      localStorage.removeItem('token');
      window.location.href = '/login'; // or use NavController
    });
  }
  
  }

