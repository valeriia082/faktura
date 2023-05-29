<?php
/**
 * Plugin Name: Faktura fields
 * Description: A custom plugin to modify WooCommerce functionality.
 * Version: 1.0
 * Author: Valeriia
 */


add_action( 'woocommerce_checkout_after_customer_details', 'add_invoice_checkbox' );
function add_invoice_checkbox() {
    echo '<div class="col2-set">';
    echo '<div class="form-row form-row-wide"><label class="woocommerce-form__label-for-checkbox checkbox"><input type="checkbox" class="input-checkbox" id="invoice_checkbox" name="invoice_checkbox" value="1"/><span>' . __(' Chce fakturę', 'woocommerce') . '</span> </label></div>';
    woocommerce_form_field( 'nip_number', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'nip-field', 'invoice-fields'),
        'label'         => __('NIP Number', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'nip_number' ));

    woocommerce_form_field( 'invoice_name', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_name', 'invoice-fields'),
        'label'         => __('Imię', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_name' ));

    woocommerce_form_field( 'invoice_surname', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_surname', 'invoice-fields'),
        'label'         => __('Nazwisko', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_surname' ));

    woocommerce_form_field( 'invoice_company', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_company', 'invoice-fields'),
        'label'         => __('Nazwa firmy', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_company' ));

    woocommerce_form_field( 'invoice_adress', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_adress', 'invoice-fields'),
        'label'         => __('Ulica/numer domu', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_adress' ));

    woocommerce_form_field( 'invoice_postalcode', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_postalcode', 'invoice-fields'),
        'label'         => __('Kod pocztowy', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_postalcode' ));

    woocommerce_form_field( 'invoice_city', array(
        'type'          => 'text',
        'class'         => array('form-row-wide', 'invoice_city', 'invoice-fields'),
        'label'         => __('Miasto', 'woocommerce'),
        'required'      => true,
        'autocomplete'  => 'off',
    ), WC()->checkout->get_value( 'invoice_city' ));

    echo '</div>';
}


add_action( 'woocommerce_checkout_create_order', 'save_invoice_checkbox' );
function save_invoice_checkbox( $order ) {
    if ( isset( $_POST['invoice_checkbox'] ) ) {
        $order->update_meta_data( '_invoice_checkbox', 'yes' );
    }
    if ( isset( $_POST['nip_number'] ) ) {
        $order->update_meta_data( '_nip_number', sanitize_text_field( $_POST['nip_number'] ) );
    }
    if ( isset( $_POST['invoice_name'] ) ) {
        $order->update_meta_data( '_invoice_name', sanitize_text_field( $_POST['invoice_name'] ) );
    }
    if ( isset( $_POST['invoice_surname'] ) ) {
        $order->update_meta_data( '_invoice_surname', sanitize_text_field( $_POST['invoice_surname'] ) );
    }
    if ( isset( $_POST['invoice_company'] ) ) {
        $order->update_meta_data( '_invoice_company', sanitize_text_field( $_POST['invoice_company'] ) );
    }
    if ( isset( $_POST['invoice_adress'] ) ) {
        $order->update_meta_data( '_invoice_adress', sanitize_text_field( $_POST['invoice_adress'] ) );
    }
    if ( isset( $_POST['invoice_postalcode'] ) ) {
        $order->update_meta_data( '_invoice_postalcode', sanitize_text_field( $_POST['invoice_postalcode'] ) );
    }
    if ( isset( $_POST['invoice_city'] ) ) {
        $order->update_meta_data( '_invoice_city', sanitize_text_field( $_POST['invoice_city'] ) );
    }

}
add_action( 'woocommerce_order_details_after_order_table', 'display_invoice_checkbox' );
function display_invoice_checkbox( $order ) {
    $invoice_checkbox = $order->get_meta( '_invoice_checkbox' );
    if ( $invoice_checkbox ) {
        echo '<p style="margin:0;"><strong>' . __('Chce fakturę', 'woocommerce') . '</strong></p>';
    }
    $nip_number = $order->get_meta( '_nip_number', true );
    if ( ! empty( $nip_number ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'NIP Number', 'woocommerce' ) . ':</strong> ' . esc_html( $nip_number ) . '</p>';
    }
    $invoice_name = $order->get_meta( '_invoice_name', true );
    if ( ! empty( $invoice_name ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Imię', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_name ) . '</p>';
    }
    $invoice_surname = $order->get_meta( '_invoice_surname', true );
    if ( ! empty( $invoice_surname ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Nazwisko', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_surname ) . '</p>';
    }
    $invoice_company = $order->get_meta( '_invoice_company', true );
    if ( ! empty( $invoice_company ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Nazwa firmy ', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_company ) . '</p>';
    }
    $invoice_adress = $order->get_meta( '_invoice_adress', true );
    if ( ! empty( $invoice_adress ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Ulica/numer domu', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_adress ) . '</p>';
    }
    $invoice_postalcode = $order->get_meta( '_invoice_postalcode', true );
    if ( ! empty( $invoice_postalcode ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Kod pocztowy', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_postalcode ) . '</p>';
    }
    $invoice_city = $order->get_meta( '_invoice_city', true );
    if ( ! empty( $invoice_city ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Miasto', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_city ) . '</p>';
    }
}
add_filter( 'woocommerce_email_order_meta_fields', 'add_invoice_checkbox_to_emails', 10, 3 );
function add_invoice_checkbox_to_emails( $fields, $sent_to_admin, $order ) {
    $invoice_checkbox = $order->get_meta( '_invoice_checkbox' );
    if ( $invoice_checkbox ) {
        $fields['invoice_checkbox'] = array(
            'label' => __('Chce fakturę', 'woocommerce'),
            'value' => 'Tak',
        );
    }
    $nip_number = $order->get_meta( '_nip_number', true );
    if ( ! empty( $nip_number ) ) {
        $fields['nip_number'] = array(
            'label' => __( 'NIP Number', 'woocommerce' ),
            'value' => esc_html( $nip_number ),
        );
    }
    $invoice_name = $order->get_meta( '_invoice_name', true );
    if ( ! empty( $invoice_name ) ) {
        $fields['invoice_name'] = array(
            'label' => __( 'Imię', 'woocommerce' ),
            'value' => esc_html( $invoice_name ),
        );
    }
    $invoice_surname = $order->get_meta( '_invoice_surname', true );
    if ( ! empty( $invoice_surname ) ) {
        $fields['invoice_surname'] = array(
            'label' => __( 'Nazwisko', 'woocommerce' ),
            'value' => esc_html( $invoice_surname ),
        );
    }
    $invoice_company = $order->get_meta( '_invoice_company', true );
    if ( ! empty( $invoice_company ) ) {
        $fields['invoice_company'] = array(
            'label' => __( 'Nazwa firmy', 'woocommerce' ),
            'value' => esc_html( $invoice_company ),
        );
    }
    $invoice_adress = $order->get_meta( '_invoice_adress', true );
    if ( ! empty( $invoice_adress ) ) {
        $fields['invoice_adress'] = array(
            'label' => __( 'Ulica/numer domu', 'woocommerce' ),
            'value' => esc_html( $invoice_adress ),
        );
    }
    $invoice_postalcode = $order->get_meta( '_invoice_postalcode', true );
    if ( ! empty( $invoice_postalcode ) ) {
        $fields['invoice_postalcode'] = array(
            'label' => __( 'Kod pocztowy', 'woocommerce' ),
            'value' => esc_html( $invoice_postalcode ),
        );
    }
    $invoice_city = $order->get_meta( '_invoice_city', true );
    if ( ! empty( $invoice_city ) ) {
        $fields['invoice_city'] = array(
            'label' => __( 'Miasto', 'woocommerce' ),
            'value' => esc_html( $invoice_city ),
        );
    }
    return $fields;
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_invoice_checkbox_admin_order_meta', 10, 1 );
function display_invoice_checkbox_admin_order_meta( $order ) {
    $invoice_checkbox = $order->get_meta( '_invoice_checkbox' );
    if ( $invoice_checkbox ) {
        echo '<p style="margin:0;"><strong>' . __('Chce fakturę', 'woocommerce') . '</strong>: Tak</p>';
    }
    $nip_number = $order->get_meta( '_nip_number', true );
    if ( ! empty( $nip_number ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'NIP Number', 'woocommerce' ) . ':</strong> ' . esc_html( $nip_number ) . '</p>';
    }
    $invoice_name = $order->get_meta( '_invoice_name', true );
    if ( ! empty( $invoice_name ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Imię', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_name ) . '</p>';
    }
    $invoice_surname = $order->get_meta( '_invoice_surname', true );
    if ( ! empty( $invoice_surname ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Nazwisko', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_surname ) . '</p>';
    }
    $invoice_company = $order->get_meta( '_invoice_company', true );
    if ( ! empty( $invoice_company ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Nazwa firmy', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_company ) . '</p>';
    }
    $invoice_adress = $order->get_meta( '_invoice_adress', true );
    if ( ! empty( $invoice_adress ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Ulica/numer domu', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_adress ) . '</p>';
    }
    $invoice_postalcode = $order->get_meta( '_invoice_postalcode', true );
    if ( ! empty( $invoice_postalcode ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Kod pocztowy', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_postalcode ) . '</p>';
    }
    $invoice_city = $order->get_meta( '_invoice_city', true );
    if ( ! empty( $invoice_city ) ) {
        echo '<p style="margin:0;"><strong>' . __( 'Miasto', 'woocommerce' ) . ':</strong> ' . esc_html( $invoice_city ) . '</p>';
    }
}


add_action( 'woocommerce_checkout_process', 'validate_nip_field_value' );
function validate_nip_field_value() {
    if ( isset( $_POST['invoice_checkbox'] ) && $_POST['invoice_checkbox'] == 1 ) {
        // Check if NIP field is filled in
        if ( empty( $_POST['nip_number'] ) || empty( $_POST['invoice_name']) || empty( $_POST['invoice_surname'] ) || empty( $_POST['invoice_company'] ) || empty( $_POST['invoice_adress']) || empty( $_POST['invoice_postalcode']) || empty( $_POST['invoice_city'])
        ) {
            wc_add_notice( __( 'Pola są wymagane', 'woocommerce' ), 'error' );
        } else {
            // Check if NIP has a valid format (10 digits)
            $nip = sanitize_text_field($_POST['nip_number']);
            if (!preg_match('/^[0-9]{10}$/', $nip)) {
                wc_add_notice(__('Please enter a valid NIP number.', 'woocommerce'), 'error');
            }
        }
    }
}