import { Routes } from '@angular/router';
import { authGuard } from './guards/auth.guard';


export const routes: Routes = [
  {
    path: 'home',
    loadComponent: () => import('./home/home.page').then((m) => m.HomePage),
    canActivate: [authGuard],
  },

  {
    path: 'login',
    loadComponent: () => import('./login/login.page').then( m => m.LoginPage)
  },

  
  {
    path: 'splash',
      loadComponent: () => import('./splash/splash.page').then(m => m.SplashPage),
    },

    {
      path: '',
      redirectTo: 'splash',
      pathMatch: 'full',
    },
    
{
  path : 'profile',
  loadComponent: () => import('./profile/profile.page').then((m) => m.ProfilePage)
},
  {
    path: 'history',
    loadComponent: () => import('./history/history.page').then( m => m.HistoryPage)
  },

  {
  path: 'history',
  loadComponent: () => import('./history/history.page').then( m => m.HistoryPage)
},
  {
    path: 'outlets',
    loadComponent: () => import('./outlets/outlets.page').then( m => m.OutletsPage)
  },
  {
    path: 'register',
    loadComponent: () => import('./register/register.page').then( m => m.RegisterPage)
  },

  {
    path: 'register',
    loadComponent: () => import('./register/register.page').then(m => m.RegisterPage)
  },
  {
    path: 'booking',
    loadComponent: () => import('./booking/booking.page').then( m => m.BookingPage)
  },

  {
    path: 'booking',
    loadComponent: () => import('./booking/booking.page').then(m => m.BookingPage)
  },
  {
    path: 'redeem',
    loadComponent: () => import('./redeem/redeem.page').then( m => m.RedeemPage)
  }
  // {
  //   path: 'verify-otp',
  //   loadComponent: () => import('./verify-otp/verify-otp.page').then( m => m.VerifyOtpPage)
  // },

  // {
  //   path: 'verify-otp',
  //   loadComponent: () => import('./verify-otp/verify-otp.page').then(m => m.VerifyOtpPage)
  // }
  

];
