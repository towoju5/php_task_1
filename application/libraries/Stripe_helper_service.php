<?php
use \Stripe\Charge;
use \Stripe\Customer;
use \Stripe\Dispute;
use \Stripe\Exception;
use \Stripe\Refund;
use \Stripe\Stripe;
use \Stripe\Token;

// use Exception

class Stripe_helper_service
{
  /**
   * @var mixed
   */
  protected $_config;

  /**
   * @var mixed
   */
  private $_user_model;
  /**
   * @var mixed
   */
  private $_user_card_model;

  /**
   * @param $config
   */
  public function set_config($config)
  {
    $this->_config = $config;
  }

  /**
   * @param $user_model
   */
  public function set_user_model($user_model)
  {
    $this->_user_model = $user_model;
  }

  /**
   * @param $user_card_model
   */
  public function set_user_card_model($user_card_model)
  {
    $this->_user_card_model = $user_card_model;
  }

  /**
   * @param $charge_id
   * @param $reason
   * @param $explanation
   * @return mixed
   */
  public function create_dispute($charge_id, $reason = '', $explanation = '')
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($charge_id && $reason && $explanation)
    {
      try {
        $response = $stripe->issuing->disputes->create([
          'transaction' => $charge_id,
          'evidence'    => [
            'reason' => $reason,
            $reason  => [
              'explanation' => $explanation
            ]
          ]
        ]);

        // evidence.reason => not_received, fraudulent, duplicate, other, merchandise_not_as_described, service_not_as_described, canceled
        // reason will be dropdown

        // check additional params here: https://stripe.com/docs/api/issuing/disputes/create?lang=php

        $output['success']           = TRUE;
        $output['response']          = $response;
        $output['stripe_dispute_id'] = $response->id;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $dispute_id
   * @return mixed
   */
  public function submit_dispute($dispute_id)
  {
    // note: dispute id is the response->id from create_dispute
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($dispute_id)
    {
      try {
        $response = $stripe->issuing->disputes->submit(
          $dispute_id,
          []
        );

        // doc: https://stripe.com/docs/api/issuing/dispute/submit

        $output['success']  = TRUE;
        $output['response'] = $response;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $dispute_id
   * @return mixed
   */
  public function retrieve_dispute($dispute_id)
  {
    // note: dispute id is the response->id from create_dispute
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($dispute_id)
    {
      try {
        $response = $stripe->issuing->disputes->retrieve(
          $dispute_id,
          []
        );

        // doc: https://stripe.com/docs/api/issuing/disputes/retrieve

        $output['success']  = TRUE;
        $output['response'] = $response;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $dispute_id
   * @param $reason
   * @param $expected_at
   * @param $explanation
   * @param $product_description
   * @param $product_type
   * @return mixed
   */
  public function update_dispute($dispute_id, $reason, $expected_at, $explanation, $product_description, $product_type)
  {
    // note: dispute id is the response->id from create_dispute
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($dispute_id && $reason && $expected_at && $explanation && $product_description && $product_type)
    {
      try {
        $response = $stripe->issuing->disputes->update(
          $dispute_id,
          [
            'evidence' => [
              'reason'       => 'not_received',
              'not_received' => [
                'expected_at'         => strtotime($expected_at),
                'explanation'         => '',
                'product_description' => $product_description,
                'product_type'        => $product_type
              ]
            ]
          ]);

        // evidence.reason  => not_received, fraudulent, duplicate, other, merchandise_not_as_described, service_not_as_described, canceled
        // reason will be dropdown

        // doc: https://stripe.com/docs/api/issuing/disputes/update
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success']  = TRUE;
        $output['response'] = $response;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $result_limit
   * @return mixed
   */
  public function list_all_disputes($result_limit)
  {
    // note: limit, created, ending_before, starting_after (optional)
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient(
      $stripe_secret_key
    );

    if ($result_limit)
    {
      try {
        $response = $stripe->issuing->disputes->all(['limit' => $result_limit]);

        // limit is optional
        // reason will be dropdown

        // doc: https://stripe.com/docs/api/issuing/disputes/list
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success']  = TRUE;
        $output['response'] = $response;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $charge_id
   * @param $amount
   * @param $reason
   * @return mixed
   */
  public function create_refund($charge_id, $amount, $reason)
  {
    // note: amount is the refund amount and it has to be within the limit of paid amount
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    Stripe::setApiKey($stripe_secret_key);

    if ($charge_id)
    {
      // don't need reason, admin create refund, which return success
      try {
        $obj = Refund::create([
          'charge' => $charge_id,
          'amount' => $amount,
          'reason' => $reason
        ]);

        // reason: duplicate, fraudulent & requested_by_customer
        // doc: https://stripe.com/docs/api/refunds/create?lang=php
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success'] = TRUE;
        $output['obj']     = $obj;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $retrieve_id
   * @param $order_id
   * @return mixed
   */
  public function retrieve_refund($retrieve_id, $order_id)
  {
    // note: use order_id to track with local order->id
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    Stripe::setApiKey($stripe_secret_key);

    if ($retrieve_id && $order_id)
    {

      try {
        $obj = Refund::retrieve(
          $retrieve_id,
          ['metadata' => ['order_id' => $order_id]]
        );

        // doc: https://stripe.com/docs/api/refunds/retrieve?lang=php
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success'] = TRUE;
        $output['obj']     = $obj;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $retrieve_id
   * @param $order_id
   * @return mixed
   */
  public function update_refund($retrieve_id, $order_id)
  {
    // note: order_id is the local order->id to track
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    Stripe::setApiKey($stripe_secret_key);

    if ($retrieve_id && $order_id)
    {

      try {
        $obj = Refund::update(
          $retrieve_id,
          ['metadata' => ['order_id' => $order_id]]
        );

        // doc: https://stripe.com/docs/api/refunds/update?lang=php
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success'] = TRUE;
        $output['obj']     = $obj;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $limit
   * @return mixed
   */
  public function list_all_refunds($limit)
  {
    // note: limit, created, ending_before, starting_after (optional)
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    Stripe::setApiKey($stripe_secret_key);

    if ($limit)
    {

      try {
        $obj = Refund::all(
          ['limit' => $limit]
        );

        // doc: https://stripe.com/docs/api/refunds/list?lang=php
        // stripe date_time format: https://en.m.wikipedia.org/wiki/Unix_time
        // strtotime()

        $output['success'] = TRUE;
        $output['obj']     = $obj;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $number
   * @param $exp_month
   * @param $exp_year
   * @param $cvc
   * @return mixed
   */
  public function create_stripe_token($number, $exp_month, $exp_year, $cvc)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($number && $exp_month && $exp_year && $cvc)
    {
      try {
        $token = $stripe->tokens->create([
          'card' => [
            'number'    => $number,
            'exp_month' => $exp_month,
            'exp_year'  => $exp_year,
            'cvc'       => $cvc
          ]
        ]);

        $output['success'] = TRUE;
        $output['token']   = $token;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $customer_email
   * @param $stripe_token_id
   * @return mixed
   */
  public function create_stripe_customer_with_card($customer_email, $stripe_token_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    $stripe            = new \Stripe\StripeClient($stripe_secret_key);

    if ($customer_email)
    {
      try
      {
        $customer_data = $stripe->customers->create([
          'customer' => [
            'email' => $customer_email
          ]
        ]);

        $card_data = $stripe->customers->createSource(
          $customer_data->id,
          ['source' => $stripe_token_id]
        );

        // $card_data = Customer::createSource(
        //   $customer_data->id,
        //   [
        //     'source' => $stripe_token_id
        //   ]
        // );

        $output['success'] = TRUE;
        $output['card']    = $card_data;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $stripe_token_id
   * @param $user_id
   * @return mixed
   */
  public function add_new_card($stripe_token_id, $user_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    $get_user_data = $this->_user_model->get($user_id);

    $stripe_customer_id = $get_user_data->stripe_id;

    if ($stripe_token_id && $stripe_customer_id)
    {
      try
      {
        // assign card to the user (not default)
        $card_data = $stripe->customers->createSource(
          $stripe_customer_id,
          ['source' => $stripe_token_id]
        );

        // $card_data = Customer::createSource(
        //   $stripe_customer_id,
        //   [
        //     'source' => $stripe_token_id
        //   ]
        // );

        // set default (not needed)
        // $updated_customer_data = Customer::update(
        //   $stripe_customer_id,
        //   [
        //     'default_source' => $add_card_data->id,
        //   ]
        // );

        $output['success']   = TRUE;
        $output['card_data'] = $card_data;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $stripe_token_id
   * @param $user_id
   * @return mixed
   */
  public function update_default_card($stripe_card_id, $user_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');
    // Stripe::setApiKey($stripe_secret_key);

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    $get_user_data = $this->_user_model->get($user_id);

    $stripe_customer_id = $get_user_data->stripe_id;

    if ($stripe_card_id && $stripe_customer_id)
    {
      try
      {
        // assign card to customer
        // $add_card_data = $stripe->customers->createSource(
        //   $stripe_customer_id,
        //   ['source' => $stripe_token_id]
        // );

        // set default the card to user
        $updated_customer_data = $stripe->customers->update(
          $stripe_customer_id,
          ['default_source' => $stripe_card_id]
        );

        $output['success']               = TRUE;
        $output['updated_customer_data'] = $updated_customer_data;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }

  /**
   * @param $token_id
   * @param $amount
   * @param $description
   * @return mixed
   */
  public function create_stripe_simple_charge($token_id, $amount, $description = '')
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    if ($token_id && $amount)
    {
      try
      {
        $charge = $stripe->charges->create([
          'amount'      => $amount,
          'currency'    => 'usd',
          'source'      => $token_id,
          'description' => $description
        ]);

        $output['success']  = TRUE;
        $output['response'] = $charge;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Token and Amount is required.";
      return $output;
      exit();
    }
  }

  /**
   * @param $user_id
   * @param $user_card_id
   * @param $amount
   * @param $description
   * @return mixed
   */
  public function create_stripe_charge($user_id, $user_card_id, $amount, $description)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    $get_user_data      = $this->_user_model->get($user_id);
    $get_user_card_data = $this->_user_card_model->get($user_card_id);

    $stripe_customer_id = $get_user_data->stripe_id;
    $stripe_card_id     = $get_user_card_data->stripe_card_id;

    if ($stripe_customer_id && $amount)
    {
      try
      {
        $charge = $stripe->charges->create([
          "amount"      => $amount * 100,
          "currency"    => "usd",
          "customer"    => $stripe_customer_id,
          "source"      => $stripe_card_id,
          "description" => $description
        ]);

        $output['success']  = TRUE;
        $output['response'] = $charge;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Token and Amount is required.";
      return $output;
      exit();
    }
  }

  /**
   * @param $user_id
   * @return mixed
   */
  public function retrieve_stripe_customer_data($user_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    Stripe::setApiKey($stripe_secret_key);

    $customer_data = $this->_user_model->get($user_id);

    $stripe_customer_id = $customer_data->stripe_id;

    if ($stripe_customer_id)
    {
      try
      {
        $retrieve = Customer::retrieve(
          $stripe_customer_id,
          []
        );

        $output['success']           = TRUE;
        $output['retrieve_customer'] = $retrieve;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Token and Amount is required.";
      return $output;
      exit();
    }
  }

  /**
   * @param $user_id
   * @param $stripe_card_id
   * @return mixed
   */
  public function retrieve_stripe_card_data($user_id, $stripe_card_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    Stripe::setApiKey($stripe_secret_key);

    $customer_data = $this->_user_model->get($user_id);

    $stripe_customer_id = $customer_data->stripe_id;

    if ($stripe_customer_id)
    {
      try
      {
        $retrieve_card = Customer::retrieveSource(
          $stripe_customer_id,
          $stripe_card_id,
          []
        );

        $output['success']       = TRUE;
        $output['retrieve_card'] = $retrieve_card;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Token and Amount is required.";
      return $output;
      exit();
    }
  }

  /**
   * @param $user_id
   * @param $stripe_card_id
   * @return mixed
   */
  public function delete_card_from_customer($user_id, $stripe_card_id)
  {
    $stripe_secret_key = $this->_config->item('stripe_secret_key');

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    $customer_data = $this->_user_model->get($user_id);

    $stripe_customer_id = $customer_data->stripe_id;

    if ($stripe_customer_id)
    {
      try
      {
        $delete_card = $stripe->customers->deleteSource(
          $stripe_customer_id,
          $stripe_card_id,
          []
        );

        $output['success'] = TRUE;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getError()->message;
        return $output;
        exit();
      }
      catch (\Exception $e)
      {
        // Something else happened, completely unrelated to Stripe
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Token and Amount is required.";
      return $output;
      exit();
    }
  }

}
