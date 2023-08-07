<?php if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2019*/
/**
 * Stripe Webhooks Api Controller
 *
 * @copyright 2021 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 *
 */

use \Stripe\Stripe;
use \Stripe\Webhook;

class Stripe_webhooks_api_controller extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $stripe_config = [
      'stripe_api_version' => ($this->config->item('stripe_api_version') ?? ''),
      'stripe_publish_key' => ($this->config->item('stripe_publish_key') ?? ''),
      'stripe_secret_key'  => ($this->config->item('stripe_secret_key') ?? '')
    ];
    $this->load->library('payment_service', $stripe_config);
    $this->load->database();
  }

  /**
   * handle stripe events
   * @see https://stripe.com/docs/api/events/types
   */
  public function index()
  {
    $payload = @file_get_contents('php://input');
    $event   = null;

    try
    {
      $event = $this->payment_service->get_stripe_event($payload);
    }
    catch (Exception $e)
    {
      http_response_code(400);
      exit();
    }

    $args = $event->data->object;

    switch ($event->type)
    {
      case 'payment_intent.succeeded':
        // $this->handle_payment_intent_succeeded($args);
        break;

      case 'payment_method.attached':
        // $this->handle_payment_method($args);
        break;

      case 'invoice.created':
        // $this->handle_invoice_created($args);
        break;

      case 'invoice.finalized':
        // $this->handle_invoice_finalized($args);
        break;

      case 'invoice.payment_failed':
        // $this->handle_invoice_payment_failed($args);
        break;

      case 'invoice.payment_succeeded':
        // $this->handle_invoice_payment_succeeded($args);
        break;

      case 'invoice.upcoming':
        // $this->handle_invoice_upcoming($args);
        break;

      case 'charge.dispute.created':
        $this->handle_dispute_created($args);
        error_log(print_r($args), true);
        break;

      case 'charge.dispute.funds_reinstated':
        $this->handle_dispute_funds_reinstated($args);
        break;

      case 'charge.dispute.funds_withdrawn':
        $this->handle_dispute_funds_withdrawn($args);
        break;

      case 'charge.dispute.updated':
        $this->handle_dispute_updated($args);
        error_log(print_r($args, true));
        break;

      case 'charge.succeeded':
        error_log(print_r($args, true));
        // $this->handle_charge_succeeded($args);
        break;

      case 'charge.refunded':
        $this->handle_charge_refunded($args);
        break;

      case 'charge.refund.updated':
        $this->handle_refund_updated($args);
        break;

      case 'checkout.session.completed':
        // $this->handle_checkout_session_completed($args);
        break;

      case 'customer.source.expiring':
        http_response_code(200);
        break;

      case 'customer.subscription.updated':
        http_response_code(200);
        break;

      case 'customer.subscription.deleted':
        // $this->handle_subscription_deleted($args);
        break;

      case 'subscription_schedule.aborted':
        // $this->handle_subscription_schedule_aborted($args);
        break;

      case 'subscription_schedule.canceled':
        // $this->handle_subscription_schedule_canceled($args);
        break;

      case 'subscription_schedule.completed':
        // $this->handle_subscription_schedule_completed($args);
        break;

      case 'subscription_schedule.expiring':
        // $this->handle_subscription_schedule_expiring($args);
        break;

      default:
        http_response_code(200);
        exit();
    }
  }

  /**
   * Dispute:
   * https://stripe.com/docs/api/disputes/object
   */
  public function handle_dispute_created($args)
  {
    $this->load->model('dispute_model');
    $this->load->model('order_model');
    $this->load->model('order_notes_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data = $this->order_model->get_by_field('stripe_charge_id', $args['charge']);

      // if (!empty($order_data))
      // {
      $payload = [
        'order_id'          => $order_data->id ?? 0,
        'user_id'           => $order_data->user_id ?? 0,
        'amount'            => $args['amount'] ?? "",
        'reason'            => $args['reason'] ?? "",
        'explanation'       => $args['explanation'] ?? "",
        'stripe_charge_id'  => $args['charge'] ?? "",
        'stripe_dispute_id' => $args['id'] ?? "",
        'status'            => $args['status'] ?? ""
      ];

      $result = $this->dispute_model->create($payload);

      if ($result)
      {
        $order_notes_payload = [
          'order_id'    => $order_data->id ?? 0,
          'description' => 'Dispute created.'
        ];

        $this->order_notes_model->create($order_notes_payload);

        echo json_encode(["success" => true, "message" => "dispute created succeeded captured"]);
        http_response_code(200);
        exit();
      }
      else
      {
        echo json_encode(["success" => false, "message" => "dispute created failed"]);
        http_response_code(400);
        exit();
      }
    }
    // else
    // {
    //   echo json_encode(["success" => false, "message" => "order data not found"]);
    //   http_response_code(400);
    //   exit();
    // }
    // }
    echo json_encode(["success" => false, "message" => "invalid dispute received"]);
    http_response_code(400);
    exit();
  }

  /**
   * Occurs when funds are reinstated to your account after a dispute is closed.
   * This includes partially refunded payments.
   */
  public function handle_dispute_funds_reinstated($args)
  {
    $this->load->model('dispute_model');
    $this->load->model('order_model');
    $this->load->model('order_notes_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data = $this->order_model->get_by_field('stripe_charge_id', $args['charge']);

      if (!empty($order_data))
      {
        $dispute_data = $this->dispute_model->get_by_field('stripe_dispute_id', $args['id']);

        $payload = [
          'amount'      => $args['amount'] ?? "",
          'reason'      => $args['reason'] ?? "",
          'explanation' => $args['explanation'] ?? "",
          'status'      => $args['status']
        ];

        $result = $this->dispute_model->edit($payload, $dispute_data->id);

        if ($result)
        {
          $order_notes_payload = [
            'order_id'    => $order_data->id,
            'description' => 'Dispute reinstated. Partial dispute. Amount ' . $args['amount'] / 100
          ];

          $this->order_notes_model->create($order_notes_payload);

          if (!empty($order_data))
          {
            $order_payload = ['status' => 6];
            $this->order_model->edit($order_payload, $order_data->id);
          }

          echo json_encode(["success" => true, "message" => "dispute reinstate succeeded"]);
          http_response_code(200);
          exit();
        }
        else
        {
          echo json_encode(["success" => false, "message" => "dispute reinstate failed"]);
          http_response_code(400);
          exit();
        }
      }
      else
      {
        echo json_encode(["success" => false, "message" => "order data not found"]);
        http_response_code(400);
        exit();
      }
    }
    echo json_encode(["success" => false, "message" => "invalid dispute received"]);
    http_response_code(400);
    exit();
  }

  /**
   * Occurs when funds are removed from your account due to a dispute.
   */
  public function handle_dispute_funds_withdrawn($args)
  {
    $this->load->model('dispute_model');
    $this->load->model('order_model');
    $this->load->model('order_notes_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data = $this->order_model->get_by_field('stripe_charge_id', $args['charge']);

      if (!empty($order_data))
      {
        $dispute_data = $this->dispute_model->get_by_field('stripe_dispute_id', $args['id']);

        $payload = [
          'amount'      => $args['amount'] ?? "",
          'reason'      => $args['reason'] ?? "",
          'explanation' => $args['explanation'] ?? "",
          'status'      => $args['status']
        ];

        $result = $this->dispute_model->edit($payload, $dispute_data->id);

        if ($result)
        {
          $order_notes_payload = [
            'order_id'    => $order_data->id,
            'description' => 'Dispute funds_withdrawn'
          ];

          $this->order_notes_model->create($order_notes_payload);

          if (!empty($order_data))
          {
            $order_payload = ['status' => 6];
            $this->order_model->edit($order_payload, $order_data->id);
          }

          echo json_encode(["success" => true, "message" => "dispute funds_withdrawn succeeded"]);
          http_response_code(200);
          exit();
        }
        else
        {
          echo json_encode(["success" => false, "message" => "dispute funds_withdrawn failed"]);
          http_response_code(400);
          exit();
        }
      }
      else
      {
        echo json_encode(["success" => false, "message" => "order data not found"]);
        http_response_code(400);
        exit();
      }
    }
    echo json_encode(["success" => false, "message" => "invalid dispute received"]);
    http_response_code(400);
    exit();
  }

  /**
   * Occurs when the dispute is updated (usually with evidence).
   */
  public function handle_dispute_updated($args)
  {
    $this->load->model('dispute_model');
    $this->load->model('order_model');
    $this->load->model('order_notes_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data = $this->order_model->get_by_field('stripe_charge_id', $args['charge']);

      if (!empty($order_data))
      {
        $dispute_data = $this->dispute_model->get_by_field('stripe_dispute_id', $args['id']);

        $payload = [
          'amount'      => $args['amount'] ?? "",
          'reason'      => $args['reason'] ?? "",
          'explanation' => $args['explanation'] ?? "",
          'status'      => $args['status']
        ];

        $result = $this->dispute_model->edit($payload, $dispute_data->id);

        if ($result)
        {
          $order_notes_payload = [
            'order_id'    => $order_data->id,
            'description' => 'Dispute dispute updated. Evidence: ' . $args['evidence'] ?? ""
          ];

          $this->order_notes_model->create($order_notes_payload);

          echo json_encode(["success" => true, "message" => "dispute update succeeded"]);
          http_response_code(200);
          exit();
        }
        else
        {
          echo json_encode(["success" => false, "message" => "dispute update failed"]);
          http_response_code(400);
          exit();
        }
      }
      else
      {
        echo json_encode(["success" => false, "message" => "order data not found"]);
        http_response_code(400);
        exit();
      }
    }
    echo json_encode(["success" => false, "message" => "invalid dispute received"]);
    http_response_code(400);
    exit();
  }

  /**
   * Refund:
   *
   */
  public function handle_charge_refunded($args)
  {
    $this->load->model('order_model');
    $this->load->model('order_notes_model');
    $this->load->model('refund_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data = $this->order_model->get_by_field('stripe_charge_id', $args['id']);

      $refund_params = [
        'order_id'          => $order_data->id ?? 0,
        'user_id'           => $order_data->user_id ?? 0,
        'amount'            => $args['amount_refunded'] ?? 0,
        'reason'            => $args['refunds']['data'][0]['reason'] ?? "null",
        'explanation'       => $args['refunds']['data'][0]['explanation'] ?? "",
        'stripe_charge_id'  => $args['id'],
        'stripe_invoice_id' => $args['invoice'] ?? "",
        'receipt_url'       => $args['receipt_url'] ?? "",
        'status'            => $args['refunds']['data'][0]['status'] ?? ""
      ];

      $result = $this->refund_model->create($refund_params);

      if ($result)
      {
        $order_notes_payload = [
          'order_id'    => $order_data->id ?? 0,
          'description' => 'Refund completed.'
        ];

        $this->order_notes_model->create($order_notes_payload);

        if (!empty($order_data))
        {
          $order_payload = ['status' => 5];
          $this->order_model->edit($order_payload, $order_data->id);
        }

        echo json_encode(["success" => true, "message" => "refund captured"]);
        http_response_code(200);
        exit();
      }
      else
      {
        echo json_encode(["success" => true, "message" => "charge refund add failed on db"]);
        http_response_code(400);
        exit();
      }

    }
    echo json_encode(["success" => true, "message" => "charge refunded captured"]);
    http_response_code(400);
    exit();
  }

  public function handle_refund_updated($args)
  {
    $this->load->model('order_model');
    $this->load->model('order_notes_model');
    $this->load->model('refund_model');

    if (isset($args['id']))
    {
      // get order_id and user_id
      $order_data  = $this->order_model->get_by_field('stripe_charge_id', $args['id']);
      $refund_data = $this->order_model->get_by_field('stripe_charge_id', $args['id']);

      if ($refund_data)
      {
        $refund_params = [
          'amount'            => $args['amount_refunded'] ?? 0,
          'reason'            => $args['refunds']['data'][0]['reason'] ?? "null",
          'explanation'       => $args['refunds']['data'][0]['explanation'] ?? "",
          'stripe_charge_id'  => $args['id'],
          'stripe_invoice_id' => $args['invoice'] ?? "",
          'receipt_url'       => $args['receipt_url'] ?? "",
          'status'            => $args['refunds']['data'][0]['status'] ?? ""
        ];

        $result = $this->refund_model->edit($refund_params, $refund_data->id);

        if ($result)
        {
          $order_notes_payload = [
            'order_id'    => $order_data->id ?? 0,
            'description' => 'Refund updated.'
          ];

          $this->order_notes_model->create($order_notes_payload);

          if (!empty($order_data))
          {
            $order_payload = ['status' => 5];
            $this->order_model->edit($order_payload, $order_data->id);
          }

          echo json_encode(["success" => true, "message" => "refund updated"]);
          http_response_code(200);
          exit();
        }
        else
        {
          echo json_encode(["success" => false, "message" => "refund update failed"]);
          http_response_code(400);
          exit();
        }
      }
      else
      {
        echo json_encode(["success" => false, "message" => "refund update failed. data not found on db."]);
        http_response_code(400);
        exit();
      }
    }
    echo json_encode(["success" => false, "message" => "refund update capture failed"]);
    http_response_code(400);
    exit();
  }

  /**
   * handle stripe ach events
   * @see https://stripe.com/docs/api/events/types
   */
  public function stripe_events()
  {
    $endpoint_secret = $this->config->item('stripe_endpoint_secret');

    $stripe_secret_key = $this->config->item('stripe_secret_key');
    Stripe::setApiKey($stripe_secret_key);

    $payload    = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event      = null;

    try {
      $event = Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
      );
    }
    catch (\UnexpectedValueException $e)
    {
      // Invalid payload
      http_response_code(400);
      exit();
    }
    catch (\Stripe\Exception\SignatureVerificationException $e)
    {
      // Invalid signature
      http_response_code(400);
      exit();
    }

    // Handle the event
    switch ($event->type)
    {
      case 'invoice.paid':
        $payment_intent = $event->data->object;
        // write your stripe webhook code here
        // contains a StripePaymentIntent
        // $this->handle_invoice_paid_method($payment_intent);
        break;
      default:
        echo 'Received unknown event type ' . $event->type;
    }

    http_response_code(200);
  }

}
