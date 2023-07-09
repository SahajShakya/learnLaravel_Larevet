<?php
namespace App\Models;

    class oldListing {
        public static function all() {
            return [
                [
                    'id' => 1,
                    'title' => 'list One',
                    'description' => 'lorem'
                ],
                [
                    'id' => 2,
                    'title' => 'list two',
                    'description' => 'lorem'
                ],
            ];
        }

        public static function find($id) {
            $listings = self::all();
            foreach ($listings as $listing) {
                if($listing['id']==$id) {
                    return @$listing;
                }
            }
        }
    }
