import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, NavController } from '@ionic/angular';

@Component({
  selector: 'app-redeem',
  standalone: true,
  imports: [CommonModule, FormsModule, IonicModule],
  templateUrl: './redeem.page.html',
  styleUrls: ['./redeem.page.scss'],
})
export class RedeemPage {
  userPoints = 1200;

  rewards = [
    { name: 'RM10 Voucher', points: 300, img: 'assets/rewards/voucher10.png' },
    { name: 'RM20 Voucher', points: 500, img: 'assets/rewards/voucher20.png' },
    { name: 'Car Wash Coupon', points: 150, img: 'assets/rewards/carwash.png' },
    { name: 'Free Battery Check', points: 100, img: 'assets/rewards/batterycheck.png' }
  ];

  constructor(private navCtrl: NavController) {}

  redeemItem(item: any) {
    if (this.userPoints >= item.points) {
      this.userPoints -= item.points;
      alert(`You have successfully redeemed: ${item.name}`);
    } else {
      alert('Insufficient points to redeem this item.');
    }
  }
}
