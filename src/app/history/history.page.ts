import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import {
  IonContent,
  IonHeader,
  IonTitle,
  IonToolbar,
  IonButtons,
  IonBackButton,
  IonCard,
  IonItem,
  IonThumbnail,
  IonLabel,
  IonList
} from '@ionic/angular/standalone';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-history',
  templateUrl: './history.page.html',
  styleUrls: ['./history.page.scss'],
  standalone: true,
  imports: [
    IonContent,
    IonHeader,
    IonTitle,
    IonToolbar,
    IonButtons,
    IonBackButton,
    IonCard,
    IonItem,
    IonThumbnail,
    IonLabel,
    IonList,
    CommonModule,
    FormsModule
  ]
})
export class HistoryPage implements OnInit {
  user: any;

  orderHistory = [
    {
      date: '12/01/2023',
      code: 'XYZ24DR',
      items: [
        { name: 'Clay face mask', qty: 2, price: 850, img: 'assets/products/clay.png' },
        { name: 'Eyeshadow', qty: 1, price: 585, img: 'assets/products/eyeshadow.png' }
      ]
    },
    {
      date: '11/11/2023',
      code: 'XTT24DR',
      items: [
        { name: 'Shampoo set', qty: 1, price: 1129, img: 'assets/products/shampoo.png' }
      ]
    }
  ];

  constructor(private http: HttpClient) {}

  ngOnInit() {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders({ Authorization: `Bearer ${token}` });

    this.http.get<any>('http://127.0.0.1:8000/api/user', { headers }).subscribe({
      next: res => {
        this.user = res.data ?? res;
      },
      error: err => {
        console.error('Failed to fetch user:', err);
      }
    });
  }
}
