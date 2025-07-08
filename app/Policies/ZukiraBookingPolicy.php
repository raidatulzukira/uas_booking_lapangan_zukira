<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\ZukiraBooking;

    class ZukiraBookingPolicy
    {
        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user, ZukiraBooking $zukiraBooking): bool
        {
            // User hanya boleh melihat booking miliknya sendiri.
            return $user->id === $zukiraBooking->user_id;
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, ZukiraBooking $zukiraBooking): bool
        {
            // User hanya boleh mengupdate (membayar) booking miliknya sendiri.
            return $user->id === $zukiraBooking->user_id;
        }

        // Method lainnya bisa Anda biarkan false untuk saat ini.
    }