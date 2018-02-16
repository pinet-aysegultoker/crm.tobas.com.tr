<?php


class CallCenter extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'call_center';

    protected $fillable = ['id', 'KurumAdi', 'BildirimKanali', 'GelenBildirim', 'TalebeYapilanIslem', 'BildirimDurumu', 'AgacYapisi', 'CagriMerkeziniArayanKisi', 'CagriMerkeziniArayanNumara', 'CagriMerkezininArandigiIl', 'YapiAdi', 'databir', 'dataiki','is_active','staff'];

    public $timestamps = true;

}
