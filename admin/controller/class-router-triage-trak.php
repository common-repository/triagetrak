<?php

/**
 * The file that defines the router class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

if (!class_exists('Triage_Trak_Router')) {

    class Triage_Trak_Router
    {
       const API_URL = 'https://account.bboapps.com';
       
            //staging url
        // const API_URL = 'http://ec2-3-144-98-168.us-east-2.compute.amazonaws.com:3001';
      
        const BUCKET_URL = 'https://s3.us-east-1.amazonaws.com/points-group-prod/';
        const LOGIN_ROUTE = '/api/sts/login';
        const REFRESH_TOKEN_ROUTE = '/api/sts/refresh';

//        const DOCTORS_ROUTE = '/api/triage-ms/doctors/?scope[]=withBodyParts&scope[]=withLanguages&scope[]=withDepartments&scope[]=withProcedures&scope[]=withConditions&scope[]=withPractice&scope[]=withLocations&scope[]=preview&scope[]=withFiles&scope[]=withSubSpecialties&scope[]=doctorFilter&scope[]=withCredentials&scope[]=withInsurances&scope[]=withInjuryTypes&sort=dnd_order&per_page=400';
//        const LOCATIONS_ROUTE = '/api/locations-ms/locations/?scope[]=withDoctors&scope[]=withState&scope[]=withDepartments&scope[]=locationsFilter&scope[]=withFiles&scope[]=withPhoneNumbers&per_page=20';
        const DOCTORS_ROUTE = '/api/triage-ms/doctors/all/';
        const LOCATIONS_ROUTE = '/api/locations-ms/locations/all/';

        const DOCTORS_CHANGES_ROUTE = '/api/triage-ms/v1/doctors/has-updates?from=';
        const LOCATIONS_CHANGES_ROUTE = '/api/locations-ms/v1/locations/has-updates?from=';

        const IMAGES_ROUTE = '/api/files-ms/files/all';

        public static function get_doctors_changes_route()
        {
            return self::DOCTORS_CHANGES_ROUTE;
        }

        public static function get_locations_changes_route()
        {
            return self::LOCATIONS_CHANGES_ROUTE;
        }

        public static function get_bucket_url()
        {
            return self::BUCKET_URL;
        }

        public static function get_api_url()
        {
            return self::API_URL;
        }

        public static function get_login_route()
        {
            return self::LOGIN_ROUTE;
        }

        public static function get_refresh_token_route()
        {
            return self::REFRESH_TOKEN_ROUTE;
        }

        public static function get_locations_route()
        {
            return self::LOCATIONS_ROUTE;
        }

        public static function get_doctors_route()
        {
            return self::DOCTORS_ROUTE;
        }
        public static function get_images_route()
        {
            return self::IMAGES_ROUTE;
        }
    }
}