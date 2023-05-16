<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models{
    /**
     * App\Models\Account
     *
     * @property int $id
     * @property string $token
     * @property string|null $temporary_token
     * @property string|null $temporary_token_expires_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $GetProducts
     * @property-read int|null $get_products_count
     * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Account query()
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereTemporaryToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereTemporaryTokenExpiresAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
     */
    class Account extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Account_users
     *
     * @property int $id
     * @property int $account_id
     * @property int $user_id
     * @property int $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users query()
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereAccountId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Account_users whereUserId($value)
     */
    class Account_users extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Product
     *
     * @property int $id
     * @property string $name
     * @property string|null $brand
     * @property string|null $quantity_in_package
     * @property string $barcode
     * @property string|null $image
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $accounts
     * @property-read int|null $accounts_count
     * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product query()
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarcode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantityInPackage($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
     */
    class Product extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $Connections
     * @property-read int|null $connections_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $GetConnections
     * @property-read int|null $get_connections_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $accounts
     * @property-read int|null $accounts_count
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\account_products
     *
     * @property int $id
     * @property int $account_id
     * @property int $product_id
     * @property string|null $expiration_date
     * @property string|null $ran_out_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|account_products newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|account_products newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|account_products query()
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereAccountId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereExpirationDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereProductId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereRanOutAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|account_products whereUpdatedAt($value)
     */
    class account_products extends \Eloquent
    {
    }
}
