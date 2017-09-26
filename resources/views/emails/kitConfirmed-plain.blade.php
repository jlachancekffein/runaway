{{ trans('kits.emailConfirmedTitle', compact('customerName', 'kitName')) }}

{{ trans('kits.emailConfirmedText', ['name' => $customerName]) }}

{{ trans('kits.emailConfirmedNameField') }}
<?= $customerName ?>


{{ trans('kits.emailConfirmedKitNameField') }}
<?= $kitName ?>


{{ trans('kits.emailConfirmedTransactionField') }}
<?= $transactionId ?>


{{ trans('kits.emailConfirmedTransactionDateField') }}
<?= $transactionDate ?>


{{ trans('kits.emailConfirmedButton') }}
<?= $link ?>