<?php

namespace App\Models;

use App\User;
use App\Traits\MultiTenantTrait;
use App\Traits\PaginateCollectionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property string $id
 * @property string $tenant_id
 * @property string $vendor_id
 * @property string $name Nome do empreendimento
 * @property string $street Rua em que o empreendimento está localizado
 * @property string $city Cidade em que o empreendimento está localizado
 * @property string $state Estado em que o empreendimento está localizado
 * @property string $country Pais em que o empreendimento está localizado
 * @property string $postcode Cep do endereço do empreendimento
 * @property int $active Se o empreendimento está ativo ou não
 * @property \Illuminate\Support\Carbon|null $start_new Definir Produto como Novo de
 * @property \Illuminate\Support\Carbon|null $end_new Definir Produto como Novo até
 * @property int $type Tipo de Empreendimento, (Aberto, Fechado,Semi Fechado
 * @property int $utm Zona UTM
 * @property float $lat Latitude
 * @property float $long Longitude
 * @property int $offset_north Ajuste Norte Coordenada Mercator
 * @property int $offset_east Ajuste Leste Coordenada Mercator
 * @property float $total_area Área total
 * @property float $total_area_of_itens Área Total de Lotes
 * @property float $green_area Área Verde
 * @property float $common_area Área Comum
 * @property int $product_status Status do Empreendimento (Pré-lançamento, lançamento, Em Obras, Pronto para Morar)
 * @property \Illuminate\Support\Carbon|null $estimated_conclusion Previsão de término
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $meta_url
 * @property string|null $short_description Descrição Resumida
 * @property string|null $description Descrição
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $amenity_description Descrição sobre a comodidade do empreendimento
 * @property string|null $safety_description Descrição sobre a segurança do empreendimento
 * @property string|null $recreation_description Descrição sobre o lazer do empreendimento
 * @property string|null $advantage_first Vantagem do empreendimento
 * @property string|null $advantage_second Vantagem do empreendimento
 * @property string|null $advantage_third Vantagem do empreendimento
 * @property string|null $advantage_fourth Vantagem do empreendimento
 * @property string|null $advantage_fifth Vantagem do empreendimento
 * @property string $number
 * @property string $neighborhood
 * @property string|null $complement
 * @property string|null $coordinator_id
 * @property array|null $coords_xy
 * @property string|null $category_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Amenity[] $amenities
 * @property-read int|null $amenities_count
 * @property-read \App\Models\Category|null $category
 * @property-read User|null $coordinator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Proposal[] $proposals
 * @property-read int|null $proposals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Scheduling[] $schedulings
 * @property-read int|null $schedulings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $specialists
 * @property-read int|null $specialists_count
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Vendor $vendor
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdvantageFifth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdvantageFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdvantageFourth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdvantageSecond($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdvantageThird($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAmenityDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCommonArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereComplement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCoordinatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCoordsXy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEndNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEstimatedConclusion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGreenArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOffsetEast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOffsetNorth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRecreationDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSafetyDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStartNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTotalArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTotalAreaOfItens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUtm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVendorId($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes, MultiTenantTrait, PaginateCollectionTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'products';

    const ACTIVE = 1;
    const ABERTO = 1;
    const FECHADO = 2;
    const SEMI_FECHADO = 3;
    const BAIRRO_PLANEJADO = 4;
    const CONDOMINIO_FECHADO = 5;

    const TYPES = [
        self::ABERTO => 'Loteamento Aberto',
        self::FECHADO => 'Loteamento Fechado',
        self::BAIRRO_PLANEJADO => 'Bairro Planejado',
        self::CONDOMINIO_FECHADO => 'Condominio Fechado',
    ];

    const PRE_LANCAMENTO = 1;
    const LANCAMENTO = 2;
    const EM_OBRAS = 3;
    const PRONTO_PARA_MORAR = 4;

    const STATUS = [
        self::PRE_LANCAMENTO => 'Pré Lançamento',
        self::LANCAMENTO => 'Lançamento',
        self::EM_OBRAS => 'Em Obras',
        self::PRONTO_PARA_MORAR => 'Pronto para Construir',
    ];

    protected $fillable =[
    #FASE 1
        'tenant_id',
        'vendor_id',
        'coordinator_id',
        'especialist_id',
        'category_id',
        'name',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'country',
        'postcode',
        'responsible_for',
    #FASE 2
        'active',
        'start_new',
        'end_new',
        'type',
        'utm',
        'lat',
        'long',
        'offset_north',
        'offset_east',
        'coords_xy',
    #FASE 3
        'total_area',
        'total_area_of_itens',
        'green_area',
        'common_area',
    #FASE 4
        'product_status',
        'estimated_conclusion',

    #FASE 5
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_url',
        'short_description',
        'description',
        'amenity_description',
        'safety_description',
        'recreation_description',
        'advantage_first',
        'advantage_second',
        'advantage_third',
        'advantage_fourth',
        'advantage_fifth',

    ];

    protected $casts = [
        'estimated_conclusion' => 'date',
        'start_new' => 'date',
        'end_new' => 'date',
        'lat' => 'double',
        'long' => 'double',
        'coords_xy' => 'array',
        'offset_north' => 'integer',
        'offset_east' => 'integer',
    ];

    protected static function booted()
    {
        static::created(function ($product) {
            \Log::info($product->toJson());
        });
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(User::class, 'product_user')->withTimestamps();
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function schedulings()
    {
        return $this->hasMany(Scheduling::class);
    }

    public function setOffsetNorthAttribute($value)
    {
        $this->attributes['offset_north'] = (int)$value;
    }
    public function setOffsetEastAttribute($value)
    {
        $this->attributes['offset_east'] = (int)$value;
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}