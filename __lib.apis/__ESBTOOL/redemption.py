import sys
import zeep
import requests
from zeep import Client, xsd, Settings
from zeep.wsse.username import UsernameToken
import calendar
import time
ts = calendar.timegm(time.gmtime())

bse_order = sys.argv[1].replace("\"", "")

LIVE = 1   # 0=demo, 1=live
MEMBERID = ['15133', '15133']
USERID = ['1513301', '1513303']
PASSWORD = ['456789!', '10101@']
#PASSWORD = ['456789!', '01010@']
PASSKEY = [ts,ts]


# url for BSEStar order entry webservice which is used to create or cancel transactions
WSDL_ORDER_URL = [
    'https://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?singleWsdl',
    'https://bsestarmf.in/MFOrderEntry/MFOrder.svc?singleWsdl'
]
SVC_ORDER_URL = [
    'https://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc/Secure',
    'https://bsestarmf.in/MFOrderEntry/MFOrder.svc/Secure'
]
METHOD_ORDER_URL = [
    'https://bsestarmfdemo.bseindia.com/MFOrderEntry/',
    'https://bsestarmf.in/MFOrderEntry/'
]

# set logging such that its easy to debug soap queries
def set_soap_logging():
    import logging.config
    logging.config.dictConfig({
        'version': 1,
        'formatters': {
            'verbose': {
                'format': '%(name)s: %(message)s'
            }
        },
        'handlers': {
            'console': {
                'level': 'DEBUG',
                'class': 'logging.StreamHandler',
                'formatter': 'verbose',
            },
        },
        'loggers': {
            'zeep.transports': {
                'level': 'DEBUG',
                'propagate': True,
                'handlers': ['console'],
            },
        }
    })

def soap_get_password_order(client):

    response = client.service.getPassword(
        UserId=USERID[LIVE],
        Password=PASSWORD[LIVE],
        PassKey=PASSKEY[LIVE]
    )
    #print
    response = response.split('|')
    status = response[0]
    if (status == '100'):
        # login successful
        pass_dict = {'password': response[1], 'passkey': PASSKEY[LIVE]}
        return pass_dict
    else:
        raise Exception(
            "BSE error 640: Login unsuccessful for Order API endpoint"
        )
        #print(*response)

'''  ABOVE CODE WILL BE SAME IN ALL ACTIVITY '''

def create_transaction_bse(bse_order,transaction):

    ## settings for calling API
    settings = Settings(strict=False, force_https=True)
    ## initialise the zeep client for order wsdl
    client = zeep.Client(wsdl=WSDL_ORDER_URL[LIVE], settings=settings)
    client.service._binding_options["address"] = SVC_ORDER_URL[LIVE]
    # set_soap_logging()

    ## get the password for posting order
    pass_dict = soap_get_password_order(client)

    # prepare order, post it to BSE and save response
    # for lumpsum transaction
    if (transaction == '1'):
        ## post the transaction
        order_id = soap_post_order(client, bse_order, pass_dict, '', '', '')

    else:
        raise Exception(
            "Internal error 630: Invalid order_type in transaction table"
        )

    return order_id



def soap_post_order(client, bse_order, pass_dict, param1, param2, param3):
    # method_url = METHOD_ORDER_URL[LIVE] + 'orderEntryParam'
    # header_value = soap_set_wsa_headers(method_url, SVC_ORDER_URL[LIVE])
    bse_order = bse_order.split('|')

    response = client.service.orderEntryParam(
    bse_order[0],
        bse_order[1],
        bse_order[2],
        bse_order[3],
        bse_order[4],
        bse_order[5],
        bse_order[6],
        bse_order[7],
        bse_order[8],
        bse_order[9],
        bse_order[10],
        bse_order[11],
        bse_order[12],
        bse_order[13],
        bse_order[14],
        bse_order[15],
        bse_order[16],
        bse_order[17],
        bse_order[18],
        bse_order[19],
        bse_order[20],
        bse_order[21],
        bse_order[22],
    pass_dict['password'],
    pass_dict['passkey'],
        param1,
        param2,
        param3
    )

    ## this is a good place to put in a slack alert

    response = response.split('|')
    ## store the order response in a table

    status = response[7]
    if (status == '0'):
        # order successful
        return response
    else:
        raise Exception(
            "BSE error 641: %s" % response
        )

order_details = create_transaction_bse(bse_order,'1')
print (order_details)
