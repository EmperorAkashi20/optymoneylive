import sys
import zeep
from zeep import xsd
from zeep.transports import Transport
from zeep import Client, xsd, Settings
#from zeep.wsse.username import UsernameToken
import calendar
import time
ts = calendar.timegm(time.gmtime())
          
bse_user = sys.argv[1].replace("\"", "")
#bse_fatca = sys.argv[2].replace("\"", "")
print(*bse_user)
'''print bse_user'''

LIVE = 1
MEMBERID = ['15133', '15133']
USERID = ['1513301', '1513303']
PASSWORD = ['456789!', '10101@']
#PASSWORD = ['456789!', '01010@']
PASSKEY = [ts,ts]


# url for BSEStar upload webservice which is used to do everything besides creating/cancelling 
# transactions like create user (transactions on bse can only be placed after this) etc
WSDL_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc?singleWsdl', 
    'https://bsestarmf.in/StarMFWebService/StarMFWebService.svc?wsdl'
]
SVC_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc/Secure', 
    'https://bsestarmf.in/StarMFWebService/StarMFWebService.svc/Secure'
]
METHOD_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/2003/10/Serialization/',
    'https://bsestarmf.in/2003/10/Serialization/'
]

# every soap query to bse must have wsa headers set 
# def soap_set_wsa_headers(method_url, svc_url):
#     header = xsd.Element('bse', xsd.ComplexType([
#         xsd.Element('{http://www.w3.org/2005/08/addressing}Action', xsd.String()),
#         xsd.Element('{http://www.w3.org/2005/08/addressing}To', xsd.String())
#         ])
#     )
#     header_value = header(Action=method_url, To=svc_url)
#     return header_value


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

def soap_get_password_upload(client):
    # method_url = METHOD_ORDER_URL[LIVE] + 'getPassword'
    # svc_url = METHOD_UPLOAD_URL[LIVE]   
    # header_value = soap_set_wsa_headers(method_url, svc_url)
    
    response = client.service.getPassword(
        MemberId=MEMBERID[LIVE], 
        UserId=USERID[LIVE],
        Password=PASSWORD[LIVE], 
        PassKey=PASSKEY[LIVE]
    )
    #print(response)
    response = response.split('|')
    status = response[0]
    if (status == '100'):
        # login successful
        pass_dict = {'password': response[1], 'passkey': PASSKEY[LIVE]}
        return pass_dict
    else:
        raise Exception(
            "BSE error 640: Login unsuccessful for upload API endpoint"
        )

'''  ABOVE CODE WILL BE SAME IN ALL ACTIVITY '''

def create_p_link(bse_user):
   
    # client = zeep.Client(wsdl=WSDL_UPLOAD_URL[LIVE])
    settings = Settings(strict=False, force_https=True)
    ## initialise the zeep client for order wsdl
    client = zeep.Client(wsdl=WSDL_UPLOAD_URL[LIVE], settings=settings)
    client.service._binding_options["address"] = SVC_UPLOAD_URL[LIVE]
    set_soap_logging()
    pass_dict = soap_get_password_upload(client)
    
    ## GET THE PIPE SEPERATED VALUE FROM PHP
    '''bse_user = prepare_user_param(client_code)'''
    ## post the user creation request
    
    
    ## TODO: Log the soap request and response post the user creation request
    #pass_dict = soap_get_password_upload(client)
    user_response = get_p_link(client, bse_user, pass_dict)

    return user_response

## fire SOAP query to create a new user on bsestar
def get_p_link(client, user_param, pass_dict):
    # method_url = METHOD_UPLOAD_URL[LIVE] + 'MFAPI'
    # header_value = soap_set_wsa_headers(method_url, SVC_UPLOAD_URL[LIVE])
    response = client.service.MFAPI(
        '03',
        USERID[LIVE],
        pass_dict['password'],
        user_param
    )
    
    ## this is a good place to put in a slack alert

    response = response.split('|')
    status = response[0]
    if (status == '100'):
        link = response[1]
        return link
    else:
        raise Exception(
            "BSE error 644: Paymnet Link not avialable: %s" % response[1]
        )



vasr = create_p_link(bse_user)
print(vasr)

