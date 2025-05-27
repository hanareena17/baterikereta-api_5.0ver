import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { IonHeader, IonToolbar, IonTitle, IonContent, IonAvatar, IonButton, IonImg, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonIcon, IonSearchbar, IonFabButton, IonFab, IonItem, IonLabel } from '@ionic/angular/standalone';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';


@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
  standalone: true,
  imports: [IonHeader, IonToolbar, IonTitle, IonContent, CommonModule, IonAvatar, IonButton, IonImg, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonIcon,  IonSearchbar, IonFabButton, IonFab, IonItem, IonLabel ]
})
export class HomePage implements OnInit {
  user: any;

  navigateToAllOutlets() {
   this.router.navigate(['/outlets']);
  }
  
  goToProfile() {
    this.router.navigate(['/profile']);
  }

  goToBooking() {
    this.router.navigate(['/booking']);
  }
  
  goToRedeem() {
    this.router.navigate(['/redeem']);
  }
  
  goToTechnicianTracker() {
    this.router.navigate(['/technician-tracker']);
  }
  
  goToCart() {
    this.router.navigate(['/cart']);
  }

  goToHistory() {
    this.router.navigate(['/history']);
  }
  
  
  

  promoBanner = ''; // You can later fetch from API. If no banner, it stays blank


  outlets = [
    { name: 'TAMAN RINTING (HQ)', address: 'G01, KSL Avery Park, Jln Rinting, 81750 Masai, Johor', img: 'assets/outlets/taman_rinting.jpg' },
    { name: 'MASAI', address: '1, Jalan Berkek, Taman Bunga Raya, 81750, Masai, Johor', img: 'assets/outlets/taman_bunga_raya.jpg' },
    { name: 'SENGGARANG', address: 'No. 52, Jalan Ismail, Senggarang, 83200, Batu Pahat, Johor', img: 'assets/outlets/senggarang.jpg' },
    { name: 'BANDAR PENAWAR', address: '25, Jln Jelutong 1, Taman Desaru Utama, 81930, Bandar Penawar, Johor', img: 'assets/outlets/bandar_penawar.jpg' },
    { name: 'AYER HITAM', address: 'No.102, Jalan Batu Pahat, Taman Air Hitam, 86100 Ayer Hitam, Johor', img: 'assets/outlets/ayer_hitam.jpg' },
    { name: 'BANDAR SERI ALAM', address: '28-A, Jalan Suria 67, Bandar Seri Alam, 81750 Masai, Johor', img: 'assets/outlets/bandar_seri_alam.jpg' },
    { name: 'BATU PAHAT HQ', address: 'No.21, Jalan Murni 11, Taman Murni, 83000 Batu Pahat, Johor', img: 'assets/outlets/bp_hq.jpg' },
    { name: 'TAMAN ADDA HEIGHTS', address: 'No 32, Adda 8/1, Taman Adda, 81100 Johor Bahru, Johor', img: 'assets/outlets/adda_height.jpg' },
    { name: 'BENUT', address: 'No 3, Jalan Mutiara 3, Pusat Perniagaan Benut, 82000 Pontian, Johor', img: 'assets/outlets/benut.jpg' },
    { name: 'KOTA MASAI', address: 'No 35, Jalan Mangga 1, Taman Kota Masai, 81700 Pasir Gudang, Johor', img: 'assets/outlets/taman_kota_masai.jpg' },
    { name: 'SIMPANG RENGGAM', address: '76B, Jalan Besar, Simpang Renggam, 86200 Simpang Renggam, Johor', img: 'assets/outlets/simpang_renggam.jpg' },
    { name: 'BUKIT GAMBIR', address: 'No.115, Jalan Gambir 8, Bandar Baru Bukit Gambir, 8', img: 'assets/outlets/bukit_gambir.jpg' },
    { name: 'KLUANG', address: 'No.513, Jalan Mersing, Kluang Baru, 86000 Kluang, Johor', img: 'assets/outlets/kluang.jpg' },
    { name: 'ENDAU', address: 'No.4096, Jalan Perisai 3, Bandar Baru, 86900 Endau, Johor', img: 'assets/outlets/endau.jpg' },
    { name: 'TONGKANG PECAH', address: 'No.4, Jalan Bistari Utama, Tongkang Pechah, 83010, Batu Pahat, Johor', img: 'assets/outlets/tongkang_pecah.jpg' },
    { name: 'MOUNT AUSTIN', address: '6-71,Jalan Mutiara Emas 10/2, Taman Mount Austin, 81100 Johor Bahru, Johor', img: 'assets/outlets/mount_austin.jpg' },
    { name: 'KOTA PUTERI', address: 'G-02 Blok H, Jalan Jelatang 27, Taman Cahaya Kota Puteri, 81750, Johor Bahru, Johor', img: 'assets/outlets/kota_puteri.jpg' },
    { name: 'TAMAN IMPIAN EMAS', address: 'No 19, Jalan Anggerik Emas 1, Taman Impian Emas, 81200 Johor Bahru, Johor', img: 'assets/outlets/taman_impian_emas.jpg' },
    { name: 'GELANG PATAH', address: '09-01, Jln Nusaria 11/5, Taman Nusantara, 81550 Johor Bahru, Johor', img: 'assets/outlets/gelang_patah.png' },
    { name: 'TAMAN PERLING', address: '260, Jalan Persisiran Perling 1, Taman Perling, 81200 Johor Bahru,  Johor', img: 'assets/outlets/taman_perling.jpg' },
    { name: 'KULAI', address: '6, Jalan Gangsa 1, Taman Gunung Pulai, 81000 Kulai, Johor', img: 'assets/outlets/kulai.jpg' },
    { name: 'CAHAYA MASAI', address: 'No 21, Jalan Intan 13, Taman Cahaya Masai, 81700 Pasir Gudang, Johor', img: 'assets/outlets/taman_cahaya_masai.jpg' },
    { name: 'YONG PENG', address: '57-G, Jalan Kota, Taman Kota, 83700 Yong Peng, Johor', img: 'assets/outlets/yong_peng.jpg' },
    { name: 'SEGAMAT', address: 'No.301D, Jalan Sia Her Yam, Kampung Abdullah, 85000 Segamat, Johor', img: 'assets/outlets/segamat.jpg' },
    { name: 'TAMAN TERATAI', address: 'No.10, Jalan Enau 15, Taman Teratai, 81300 Skudai, Johor', img: 'assets/outlets/taman_teratai.jpg' },
    { name: 'TAMAN BUKIT DAHLIA', address: 'No  24, Jalan Sejambak 14, Taman Bukit Dahlia, 81700 Pasir Gudang, Johor', img: 'assets/outlets/taman_bukit_dahlia.jpg' },
    { name: 'PARIT JAWA', address: 'LC-62, Parit Raja, Batu Pahat, 86400, Batu Pahat, Johor', img: 'assets/outlets/parit_raja.jpg' },
    { name: 'PUSAT PERDAGANGAN KOTA TINGGI', address: 'L11A, Jalan Tun Sri Lanang, Pusat Perdagangan Kota Tinggi, 81900, Kota Tinggi, Johor', img: 'assets/outlets/pp_kota_tinggi.jpg' },
    { name: 'MERSING', address: '91-3,Jalan Jemaluang, Mersing,  86800 Mersing, Johor', img: 'assets/outlets/mersing.jpg' },
    { name: 'KAMPUNG MELAYU MAJIDEE', address: '2D-LP, Off Jalan Utama, Kampung Melayu Majidee, 81100 Johor Bahru, Johor', img: 'assets/outlets/kg_majidee.jpg' },
    { name: 'TAMAN SCIENTEX', address: '34A, Jalan Belatuk 3, Taman Scientex, 81700 Pasir Gudang, Johor', img: 'assets/outlets/taman_scientex.jpg' },
    { name: 'TAMAN UNIVERSITI', address: 'No.24, Jalan Kebudayaan 5, Taman Universiti, 81300 Skudai, Johor', img: 'assets/outlets/taman_universiti.jpg' },
    { name: 'PARIT JAWA', address: 'No.135, Jalan Omar, Parit Jawa, 84150 Muar, Johor', img: 'assets/outlets/parit_jawa.jpg' },
    { name: 'KOTA TINGGI', address: 'Lot A & Lot B. 8M & 8L, Jalan Tun Habab, Bandar Kota Tinggi, 81900, Kota Tinggi, Johor', img: 'assets/outlets/kota_tinggi.jpg' },
    { name: 'TAMAN CEMPAKA', address: 'No 5, Cengkerik 6,Pusat Perdagangan Kempas, 81100 Johor Bahru, Johor', img: 'assets/outlets/taman_cempaka.jpg' },
    { name: 'PULAI MUTIARA', address: 'No. 24, Jalan Pulai Mutiara 4/7, Persiaran Taman Pulai Mutiara, 81300 Skudai, Johor', img: 'assets/outlets/pulai_mutiara.jpg' },

  ];

  batteries = [
    { name: 'AMARON', img: 'assets/batteries/Amaron.jpeg' },
    { name: 'FBM ENERGY', img: 'assets/batteries/fbm.jpeg' },
    { name: 'VARTA', img: 'assets/batteries/varta.jpeg' },
    { name: 'START', img: 'assets/batteries/start.jpeg' },
    { name: 'BOSCH', img: 'assets/batteries/bosch.jpeg' },
    { name: 'TUFLONG', img: 'assets/batteries/tuflong.jpeg' },

  ];

  

  constructor(private http: HttpClient, private router: Router) {}

  ngOnInit() {
    const token = localStorage.getItem('token');
    console.log('Token in home:', token);

    if (!token) {
      alert('Please login first!');
      window.location.href = '/login';
      return;
    }

    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    this.http.get<any>('http://127.0.0.1:8000/api/user', { headers }).subscribe({
      next: res => {
        this.user = res.data ?? res;
        console.log('Authenticated user:', this.user);
      },
      error: err => {
        console.error('Failed to fetch user:', err);
        if (err.status === 401) {
          alert('Session expired. Please login again.');
          localStorage.removeItem('token');
          window.location.href = '/login';
        }
      }
    });
  }
}
