<?php 
    namespace App\Models;

    class DeviceModel extends Model {
        protected $table = 'wifi_devices';
        public $timestamps  = false;

        public function updatePassword($id, $newPassword) {
            $device = parent::where('id', $id)->first();
            $device->wifi_password = $newPassword; 
            return $device->save();
        }

        public function getPassword($id) {
            return parent::where('id', $id)->first()['wifi_password'];
        }
    }