<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// pertama di tampilkan
$route['default_controller'] = 'frontend';
// error hendling
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;


// $route[''] adalah penamaan atau alias dari url yang dipanggil 
// 'backend/dashboard/index'; adalah controller yang dipanggil melalui routes
//******************************    ADMIN    **************************************
//1. dashboard
$route['admin/dashboard']                 = 'backend/dashboard/index';
//2. login admin
$route['admin/login']                     = 'backend/auth_back/login';
$route['admin/login/aksi']                = 'backend/auth_back/login_aksi';
$route['admin/lupa/login']                = 'backend/auth_back/lupa';
$route['admin/lupa/aksi']                 = 'backend/auth_back/lupa_aksi';
$route['admin/reset/password/(:any)']     = 'backend/auth_back/reset_password/$1';
$route['admin/reset/aksi']                = 'backend/auth_back/change_password_aksi';
$route['admin/logout']                    = 'backend/auth_back/logout';

//3. pengguna sistem
$route['admin/pengguna']                  = 'backend/pengguna/index';
$route['admin/pengguna/tambah']           = 'backend/pengguna/tambah';
$route['admin/tambah_aksi']               = 'backend/pengguna/tambah_aksi';
$route['admin/pengguna/ubah/(:any)']      = 'backend/pengguna/ubah/$1';
$route['admin/ubah_aksi']                 = 'backend/pengguna/ubah_aksi';
$route['admin/pengguna/hapus/(:any)']     = 'backend/pengguna/hapus/$1';

//4. lantai hotel
$route['admin/lantai']                    = 'backend/hotel/index_lantai';
$route['admin/lantai/tambah']             = 'backend/hotel/lantai_tambah';
$route['admin/lantai_tambah_aksi']        = 'backend/hotel/lantai_tambah_aksi';
$route['admin/lantai/ubah/(:any)']        = 'backend/hotel/lantai_ubah/$1';
$route['admin/lantai_ubah_aksi']          = 'backend/hotel/lantai_ubah_aksi';
$route['admin/lantai/hapus/(:any)']       = 'backend/hotel/lantai_hapus/$1';
$route['admin/lantai/status/(:any)']      = 'backend/hotel/lantai_status/$1';

//5. tipe kamar/ tipe room
$route['admin/tipe']                      = 'backend/hotel/index_tipe';
$route['admin/tipe/tambah']               = 'backend/hotel/tipe_tambah';
$route['admin/tipe_tambah_aksi']          = 'backend/hotel/tipe_tambah_aksi';
$route['admin/tipe/ubah/(:any)']          = 'backend/hotel/tipe_ubah/$1';
$route['admin/tipe_ubah_aksi']            = 'backend/hotel/tipe_ubah_aksi';
$route['admin/tipe/hapus/(:any)']         = 'backend/hotel/tipe_hapus/$1';
$route['admin/tipe/status/(:any)']        = 'backend/hotel/tipe_status/$1';

//6. amenities/ fasilitas kamar
$route['admin/amenities']                 = 'backend/hotel/amenities_index';
$route['admin/amenities/tambah']          = 'backend/hotel/amenities_tambah';
$route['admin/amenities_tambah_aksi']     = 'backend/hotel/amenities_tambah_aksi';
$route['admin/amenities/ubah/(:any)']     = 'backend/hotel/amenities_ubah/$1';
$route['admin/amenities_ubah_aksi']       = 'backend/hotel/amenities_ubah_aksi';
$route['admin/amenities/hapus/(:any)']    = 'backend/hotel/amenities_hapus/$1';
$route['admin/amenities/status/(:any)']   = 'backend/hotel/amenities_status/$1';

//7. layanan/ layanan/
$route['admin/service']                   = 'backend/hotel/service_index';
$route['admin/service/tambah']            = 'backend/hotel/service_tambah';
$route['admin/service_tambah_aksi']       = 'backend/hotel/service_tambah_aksi';
$route['admin/service/ubah/(:any)']       = 'backend/hotel/service_ubah/$1';
$route['admin/service_ubah_aksi']         = 'backend/hotel/service_ubah_aksi';
$route['admin/service/hapus/(:any)']      = 'backend/hotel/service_hapus/$1';
$route['admin/service/status/(:any)']     = 'backend/hotel/service_status/$1';

//8.  price/ pembayaran
$route['admin/price']                     = 'backend/hotel/price_index';
$route['admin/price/tambah']              = 'backend/hotel/price_tambah';
$route['admin/price_tambah_aksi']         = 'backend/hotel/price_tambah_aksi';
$route['admin/price/ubah/(:any)']         = 'backend/hotel/price_ubah/$1';
$route['admin/price_ubah_aksi']           = 'backend/hotel/price_ubah_aksi';
$route['admin/price/hapus/(:any)']        = 'backend/hotel/price_hapus/$1';

//9. price spesial/ pembayaran range tanggal
$route['admin/price/special/(:any)']      = 'backend/hotel/price_special/$1';
$route['admin/price/special_aksi']        = 'backend/hotel/price_special_aksi';

//10. kamar / room
$route['admin/kamar']                     = 'backend/hotel/kamar_index';
$route['admin/kamar/tambah']              = 'backend/hotel/kamar_tambah';
$route['admin/kamar_tambah_aksi']         = 'backend/hotel/kamar_tambah_aksi';
$route['admin/kamar/ubah/(:any)']         = 'backend/hotel/kamar_ubah/$1';
$route['admin/kamar_ubah_aksi']           = 'backend/hotel/kamar_ubah_aksi';
$route['admin/kamar/hapus/(:any)']        = 'backend/hotel/kamar_hapus/$1';
$route['admin/kamar/status/(:any)']       = 'backend/hotel/status_ubah/$1';

//11. coupon/ voucher
$route['admin/coupon']                    = 'backend/hotel/coupon_index';
$route['admin/coupon/tambah']             = 'backend/hotel/coupon_tambah';
$route['admin/coupon_tambah_aksi']        = 'backend/hotel/coupon_tambah_aksi';
$route['admin/coupon/ubah/(:any)']        = 'backend/hotel/coupon_ubah/$1';
$route['admin/coupon_ubah_aksi']          = 'backend/hotel/coupon_ubah_aksi';
$route['admin/coupon/hapus/(:any)']       = 'backend/hotel/coupon_hapus/$1';

//12  image Galleri
$route['admin/igallery/(:any)']           = 'backend/galleri/image_index/$1';
$route['admin/igallery/tambah/(:any)']    = 'backend/galleri/image_tambah/$1';
$route['admin/igallery/tambah_aksi']      = 'backend/galleri/image_tambah_aksi';
$route['admin/igallery/ubah/(:any)']      = 'backend/galleri/image_ubah/$1';
$route['admin/igallery/ubah_aksi']        = 'backend/galleri/image_ubah_aksi';
$route['admin/igallery/hapus/(:any)']     = 'backend/galleri/image_hapus/$1';

//13. kategori gallery
$route['admin/gallery']                   = 'backend/galleri/index';
$route['admin/gallery/tambah']            = 'backend/galleri/tambah';
$route['admin/gallery/tambah_aksi']       = 'backend/galleri/tambah_aksi';
$route['admin/gallery/ubah/(:any)']       = 'backend/galleri/ubah/$1';
$route['admin/gallery/ubah_aksi']         = 'backend/galleri/ubah_aksi';
$route['admin/gallery/hapus/(:any)']      = 'backend/galleri/hapus/$1';

// $route['admin/tempmail']                   = 'backend/tempmail/index';
// $route['admin/tempmail/tambah']            = 'backend/tempmail/tambah';
// $route['admin/tempmail/tambah_aksi']       = 'backend/tempmail/tambah_aksi';
// $route['admin/tempmail/ubah/(:any)']       = 'backend/tempmail/ubah/$1';
// $route['admin/tempmail/ubah_aksi']         = 'backend/tempmail/ubah_aksi';
// $route['admin/tempmail/hapus/(:any)']      = 'backend/tempmail/hapus/$1';

//14. banner
$route['admin/banners']                   = 'backend/banners/index';
$route['admin/banners/tambah']            = 'backend/banners/tambah';
$route['admin/banners/tambah_aksi']       = 'backend/banners/tambah_aksi';
$route['admin/banners/ubah/(:any)']       = 'backend/banners/ubah/$1';
$route['admin/banners/ubah_aksi']         = 'backend/banners/ubah_aksi';
$route['admin/banners/hapus/(:any)']      = 'backend/banners/hapus/$1';

//15. Pengaturan/ Settings
$route['admin/settings']                  = 'backend/settings/index';
$route['admin/settings/ubah']             = 'backend/settings/ubah_aksi';

//16. menu Profile
$route['admin/profile']                   = 'backend/profile/index';
$route['admin/profile/ubah']              = 'backend/profile/ubah_aksi';
$route['admin/profile/ubah_password']     = 'backend/profile/ubah_password';

//17. Data tamu/customer
$route['admin/customer']                  = 'backend/tamu/index';
$route['admin/customer/tambah']           = 'backend/tamu/tambah';
$route['admin/customer/tambah_aksi']      = 'backend/tamu/tambah_aksi';
$route['admin/customer/ubah/(:any)']      = 'backend/tamu/ubah/$1';
$route['admin/customer/ubah_aksi']        = 'backend/tamu/ubah_aksi';
$route['admin/customer/view/(:any)']      = 'backend/tamu/detail/$1';
$route['admin/customer/vip_ubah/(:any)']  = 'backend/tamu/vip_ubah/$1';
$route['admin/customer/status_ubah/(:any)']= 'backend/tamu/status_ubah/$1';
$route['admin/customer/hapus/(:any)']      = 'backend/tamu/hapus/$1';

//18. Calender event
$route['admin/calender']                   = 'backend/calender/index';

//19. Booking Data
$route['admin/booking/data']               = 'backend/booking/index';
$route['admin/booking/tambah']             = 'backend/booking/tambah';
$route['admin/booking/search']             = 'backend/booking/tambah';
$route['admin/booking/detail/(:any)']      = 'backend/booking/booking/$1';
$route['admin/booking/riwayat']            = 'backend/booking/data_riwayat';
$route['admin/booking/detail_riwayat/(:any)']= 'backend/booking/booking_riwayat/$1';
$route['admin/booking/in']                   = 'backend/booking/alotroom';
$route['admin/booking/out']                  = 'backend/booking/alotroom';

//20 Report/ Laporan
$route['admin/laporan/occupancy']            = 'backend/laporan/occupancy';
$route['admin/laporan/tamu']                 = 'backend/laporan/tamu';
$route['admin/laporan/keuangan']             = 'backend/laporan/keuangan';
$route['admin/laporan/voucher']              = 'backend/laporan/voucher';
$route['admin/laporan/kamar']                = 'backend/laporan/kamar';

// cronjob/ belum jadi
$route['cronjob/transaksi']                  = 'cronjob/index';

// ###################################### Bagian Frontend ############################################
//21 tampilan depan/home/awalan
$route['home']                               ='frontend/index';
$route['']                                   = 'frontend/index';

//22. tampilan kamar/ detail kamar
$route['rooms/(:any)']                       ='frontend/kamar_detail/$1';

//23. galleri
$route['galleri']                            ='frontend/gallery';
$route['tentang']                            ='frontend/tentang';
// $route['contact']                              ='frontend/kontak';
$route['login']                              ='front/auth_front/login';
$route['login/aksi']                         ='front/auth_front/login_aksi';
$route['logout']                             ='front/auth_front/logout';
$route['register']                           ='front/auth_front/register';
$route['register/aksi']                      ='front/auth_front/register_aksi';
$route['register/activation/(:any)/(:any)']  ='front/auth_front/register_activation/$1/$1';
$route['forgot']                             ='front/auth_front/forgot';
$route['forgot/aksi']                        ='front/auth_front/forgot_aksi';
$route['reset/password/(:any)']              ='front/auth_front/reset/$1';
$route['reset/aksi']                         ='front/auth_front/reset_aksi';
// halaman account
$route['dashboard']                          ='front/account/index';
$route['profile/setting']                    ='front/account/profile';
$route['profile/setting/aksi']               ='front/account/update_profile';
$route['profile/setting_password/aksi']      ='front/account/update_password';
$route['account/download/struck/(:any)']     ='front/reservasi/pdf/$1'; 
// serach Booking (pencarian kamar)
$route['search/rooms']                       ='front/reservasi/index';
$route['booking/step']                       ='front/reservasi/step';
$route['booking/payment']                    ='front/reservasi/payment';
$route['booking/pay']                        ='front/reservasi/pay';
// pembayaran midtrans
$route['booking/payment/midtrans']           ='front/reservasi/midtrans';
$route['booking/order']                      ='front/reservasi/order';
$route['booking/info']                       = 'front/reservasi/info';
